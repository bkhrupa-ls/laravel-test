require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error(
        'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
    );
}

window.initSalesForm = function () {
    let formSalesProduct = document.getElementById('formSalesProduct');

    return {
        product: formSalesProduct.options[formSalesProduct.selectedIndex].value,
        quantity: '',
        unit_cost: '',
        selling_price: '-',

        getSellingPrice() {
            axios.post(route('ajax.sale.calc-selling-price'), {
                product: this.product,
                quantity: this.quantity,
                unit_cost: this.unit_cost
            })
                .then(response => this.selling_price = response.data.data.selling_price);
        }
    }
}

Alpine.start();
