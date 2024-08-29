@extends('_layouts.app')

@section('title')
    Forms
@endsection

@section('content')
    <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
        @foreach ($forms as $form)
            <div class="flex items-start justify-between space-x-6 border bg-white p-6">
                <p class="font-medium">{{ $form->title }}</p>
                <a class="text-gray-500" href="{{ route('forms.user', ['id' => $form->id]) }}" target="_blank">
                    <x-icons-dark.external-link />
                </a>
            </div>
        @endforeach
        <button class="border bg-white p-6" x-on:click="$store.app.toggleModal('createFormModal')">
            Create form
        </button>
    </div>
@endsection

@section('modal')
    <div x-show="$store.app.createFormModal"
        class="fixed left-0 top-0 z-[1111] h-full w-full overflow-y-auto bg-gray-700 bg-opacity-30 p-4" x-cloak
        x-data="createForm">
        <div class="mx-auto my-10 max-w-2xl space-y-6 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium">Create Form</h2>
                <button x-on:click="$store.app.toggleModal('createFormModal')">
                    <x-icons-light.x-circle />
                </button>
            </div>
            <div class="tw-form-group">
                <label for="title" class="tw-form-input-label">Title</label>
                <input type="text" id="title" x-model="title.value" class="tw-form-control" />
                <small class="tw-form-error-text" x-text="title.error"></small>
            </div>

            <div class="tw-form-group">
                <label for="description" class="tw-form-input-label">Description</label>
                <textarea id="description" x-model="description.value" class="tw-form-control"></textarea>
                <small class="tw-form-error-text" x-text="description.error"></small>
            </div>

            <div class="border-b"></div>

            <small class="tw-form-error-text" x-text="generalError"></small>

            <template x-for="(item, index) in fields">
                <div class="space-y-6 border bg-gray-50 p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="tw-form-group col-span-2">
                            <label x-bind:for="`label_${index}`" class="tw-form-input-label">Label</label>
                            <input type="text" x-bind:id="`label_${index}`" x-model="item.label.value"
                                class="tw-form-control" />
                            <small class="tw-form-error-text" x-text="item.label.error"></small>
                        </div>
                        <div class="tw-form-group">
                            <label x-bind:for="`type_${index}`" class="tw-form-input-label">Type</label>
                            <select x-bind:id="`type_${index}`" class="tw-form-control" x-model="item.type" id="">
                                @foreach ($inputs as $input)
                                    <option value="{{ $input->id }}">{{ $input->name }}</option>
                                @endforeach
                            </select>
                            <small class="tw-form-error-text" x-text="item.type.error"></small>
                        </div>

                        <template
                            x-if="item.type == {{ getTypeName('radio')->id }} || item.type == {{ getTypeName('checkbox')->id }} || item.type == {{ getTypeName('select')->id }}">
                            <div class="tw-form-group col-span-3">
                                <label class="tw-form-input-label">Add Option</label>
                                <div class="grid grid-cols-3 gap-6">

                                    <template x-for="(o, i) in item.options.value">
                                        <div class="tw-form-input-wrap">
                                            <input type="text" x-model="item.options.value[i]" class="tw-form-control" />
                                            <button class="px-1"
                                                x-on:click="item.options.value = item.options.value.filter((v, e) => e !== i)">
                                                <x-icons-dark.trash />
                                            </button>
                                        </div>
                                    </template>

                                    <button class="tw-btn border bg-white" x-on:click="item.options.value.push('')">+
                                        Add</button>
                                </div>
                                <div class="col-span-3">
                                    <small class="tw-form-error-text" x-text="item.options.error"></small>
                                </div>
                            </div>
                        </template>

                        <div class="tw-form-group">
                            <label class="tw-form-input-label">Required field</label>
                            <div class="flex space-x-2">
                                <div class="flex items-center space-x-1">
                                    <input type="radio" x-bind:name="`required_${index}`"
                                        x-bind:id="`required_yes_${index}`" x-model="item.isRequired"
                                        x-bind:value="1" />
                                    <label x-bind:for="`required_yes_${index}`">Yes</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input type="radio" x-bind:name="`required_${index}`"
                                        x-bind:id="`required_no_${index}`" x-model="item.isRequired"
                                        x-bind:value="0" />
                                    <label x-bind:for="`required_no_${index}`">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 text-right">
                            <button class="tw-btn" x-on:click="fields = fields.filter((e, i) => i !== index)">
                                <x-icons-dark.trash />
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <button class="tw-btn w-full bg-teal-500 text-white" x-on:click="addField()">add field</button>

            <div class="border-b"></div>

            <button class="tw-btn bg-sky-500 text-white" x-on:click="save()">save</button>
        </div>
    </div>
@endsection

@section('script-code')
    <script>
        Alpine.data('createForm', () => ({
            title: {
                value: "",
                error: ""
            },
            description: {
                value: "",
                error: ""
            },
            validate: true,
            fields: [],
            generalError: '',
            addField() {
                this.fields.push({
                    label: {
                        value: "",
                        error: ""
                    },
                    type: {{ getTypeName('text')->id }},
                    options: {
                        value: [],
                        error: ""
                    },
                    isRequired: 1
                });
            },
            save() {
                this.removeError()
                this.validator()
                if (this.validate) {
                    axios.post('{{ route('forms.create') }}', {
                        _token: '{{ csrf_token() }}',
                        title: this.title,
                        description: this.description,
                        data: this.fields
                    }).then(({
                        data
                    }) => {
                        if (data.type == 'FormCreated') window.location.reload();
                    }).catch(({
                        response: {
                            data
                        }
                    }) => {
                        alert(data.message);
                    })
                }
            },
            removeError() {
                this.generalError = ''
                this.title.error = ''
                this.description.error = ''
                _.forEach(this.fields, (item) => {
                    item.label.error = ''
                    item.type.error = ''
                    item.options.error = ''
                })
            },
            validator() {
                this.validate = true
                if (this.fields.length == 0) {
                    this.generalError = "Please add Fields";
                    this.validate = false
                }

                if (this.title.value === '') {
                    this.title.error = 'Please enter title'
                    this.validate = false
                }

                if (this.description.value === '') {
                    this.description.error = 'Please enter description'
                    this.validate = false
                }

                _.forEach(this.fields, (item) => {
                    if (item.label.value === '') {
                        item.label.error = 'Please enter label name'
                        this.validate = false
                    }

                    if (item.type === 'radio' || item.type === 'checkbox' || item.type === 'select') {
                        if (item.options.value.length === 0) {
                            item.options.error = "Please enter atleast  1 or more options"
                            this.validate = false
                        } else {
                            _.forEach(item.options.value, (i) => {
                                if (i === "") {
                                    item.options.error = "Please enter empty option name"
                                    this.validate = false
                                }
                            })
                        }
                    }
                })
            }
        }))
    </script>
@endsection
