import './bootstrap';

Alpine.store("app", {
    createFormModal: false,
    toggleModal(name) {
        this[name] = !this[name]
    }
})

Alpine.store("sidebar", {
    on: true,
    toggle() {
        this.on = !this.on
    },
})
