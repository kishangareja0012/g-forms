<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $form->title }} | {{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="border-b-[3px] border-b-sky-500 bg-white">
        <div class="mx-auto max-w-screen-md px-6 py-6 sm:px-12">
            <a href="{{ route('forms.user', ['id' => $form->id]) }}">{{ config('app.name') }}</a>
        </div>
    </header>
    <main>
        <form action="{{ route('form.user.submit', ['id' => $form->id]) }}" method="post">
            @csrf
            <div class="mx-auto max-w-screen-md space-y-6 px-6 py-6 sm:px-12">
                <div class="space-y-3 border border-b-[3px] border-b-sky-500 bg-white p-6">
                    <h1 class="text-lg font-medium">{{ $form->title }}</h1>
                    <p class="text-xs">{!! $form->description !!}</p>
                </div>

                @if (session()->has('errorMessage'))
                    <div class="border border-b-[3px] border-b-red-500 bg-red-50 p-6 text-sm text-red-500">
                        {{ session()->get('errorMessage') }}
                    </div>
                @endif
                @if (session()->has('successMessage'))
                    <div class="border border-b-[3px] border-b-teal-500 bg-teal-50 p-6 text-sm text-teal-700">
                        {{ session()->get('successMessage') }}
                    </div>
                @endif
                @foreach ($form->formField as $index => $field)
                    <div
                        class="@error('form_' . $field->id) !border-b-red-500 @enderror border border-b-[3px] border-b-sky-500 bg-white p-6">

                        <div class="tw-form-group space-y-3">
                            <label class="tw-form-input-label font-medium">
                                <span>{{ $field->label }}</span>
                                @if ($field->is_required)
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>

                            @switch($field->input->type)
                                @case('text')
                                    <input name="form_{{ $field->id }}" type="text" class="tw-form-control"
                                        value="{{ old('form_' . $field->id) }}" />
                                @break

                                @case('textarea')
                                    <textarea name="form_{{ $field->id }}" class="tw-form-control min-h-[100px]">{{ old('form_' . $field->id) }}</textarea>
                                @break

                                @case('radio')
                                    <div class="flex gap-6">
                                        @foreach ($field->options as $option)
                                            <div class="flex items-center space-x-1">
                                                <input type="radio" name="form_{{ $field->id }}"
                                                    id="{{ $option . '_' . $index }}" value="{{ $option }}"
                                                    {{ old('form_' . $field->id) == $option ? 'checked' : '' }} />
                                                <label for="{{ $option . '_' . $index }}">{{ $option }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @break

                                @case('checkbox')
                                    <div class="flex gap-6">
                                        @foreach ($field->options as $option)
                                            <div class="flex items-center space-x-1">
                                                <input type="checkbox" name="form_{{ $field->id }}[]"
                                                    id="{{ $option . '_' . $index }}" value="{{ $option }}"
                                                    {{ in_array($option, old('form_' . $field->id) ?? []) ? 'checked' : '' }} />
                                                <label for="{{ $option . '_' . $index }}">{{ $option }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @break

                                @case('select')
                                    <div class="flex gap-6">
                                        <select name="form_{{ $field->id }}" class="tw-form-control">
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}"
                                                    {{ old('form_' . $field->id == $option) ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @break

                                @default
                            @endswitch
                            <small class="tw-form-error-text">
                                @error('form_' . $field->id)
                                    This field is Required
                                @enderror
                            </small>
                        </div>

                    </div>
                @endforeach
                <button class="tw-btn bg-teal-500 text-white">Submit</button>
            </div>
        </form>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Alpine.start()
    </script>
</body>

</html>
