
$(document).ready(function () {

    $('#btn_register').click(function (e) {
        e.preventDefault();
        $('#success').text('');
        $('#error').text('');
        const postData = {
            'name': $('#name').val(),
            'email': $('#email').val(),
            'password': $('#password').val(),
            'confirm_password': $('#confirm_password').val()
        };
        $.ajax({
            url: "/api/register",
            type: "post",
            data: postData,
            success: function (response) {
                const message = response.message;
                $('#success').text(message);
                $(':input', '#register').val('');
            },
            error: function (error) {
                const errors = error.responseJSON.errors;
                if (Object.values(errors)[0][0] !== undefined) {
                    $('#error').text(Object.values(errors)[0][0]);
                }
            }
        });
    });


    $('#btn_login').click(function (e) {
        e.preventDefault();
        $('#success').text('');
        $('#error').text('');
        const postData = {
            'email': $('#email').val(),
            'password': $('#password').val(),
        };
        $.ajax({
            url: "/api/login",
            type: "post",
            data: postData,
            success: function (response) {
                const message = response.message;
                localStorage.setItem("token", response.data.token);
                window.location = response.data.route;
            },
            error: function (error) {
                if (error.responseJSON.errors !== undefined && Object.values(error.responseJSON.errors)[0][0] !== undefined) {
                    $('#error').text(Object.values(errors)[0][0]);
                }
                if (error.responseJSON.message !== undefined) {
                    $('#error').text(error.responseJSON.message);
                }
            }
        });
    });

    $('#calculate').click(function (e) {
        e.preventDefault();
        $('#success').text('');
        $('#error').text('');
        const postData = {
            'loan_amount': $('#loan_amount').val(),
            'annual_interest_rate': $('#annual_interest_rate').val(),
            'loan_term': $('#loan_term').val(),
            'extra_payment': $('#extra_payment').val(),
        };
        $.ajax({
            url: "/api/calculate_monthly_plan",
            type: "post",
            data: postData,
            headers: { "Authorization": "Bearer " + localStorage.getItem('token') },
            success: function (response) {
                $('#header').DataTable({
                    data: [response.data.header],
                    columns: [
                        { data: 'monthly_payment', title: 'Monthly Payment' },
                        { data: 'monthly_interest_rate', title: 'Monthly Interest' },
                        { data: 'loan_amount', title: 'Loan Amount' },
                        { data: 'annual_interest_rate', title: 'Annual Interest' }
                    ],
                    "paging": false,
                    "ordering": false,
                    "searching": false,
                    "bDestroy": true
                });
                let columns = [
                    { data: 'month_number', title: 'Month Number' },
                    { data: 'starting_balance', title: 'Starting Balance' },
                    { data: 'interest_component', title: 'Interest Component' },
                    { data: 'monthly_payment', title: 'Monthly Payment' },
                    { data: 'principal_component', title: 'Principal Component' },
                    { data: 'ending_balance', title: 'Ending Balance' },
                    { data: 'extra_payment', title: 'Extra Payment' }
                ];
                $.fn.dataTable.ext.errMode = 'none';
                $('#plan').DataTable({
                    data: response.data.plan,
                    columns: columns,
                    "paging": false,
                    "ordering": false,
                    "searching": false,
                    "bDestroy": true
                });
            },
            error: function (error) {
                if (error.responseJSON.errors !== undefined && Object.values(error.responseJSON.errors)[0][0] !== undefined) {
                    $('#error').text(Object.values(error.responseJSON.errors)[0][0]);
                }
                if (error.responseJSON.message !== undefined) {
                    $('#error').text(error.responseJSON.message);
                }
            }
        });
    });

    $('#logout').click(function () {
        localStorage.removeItem("token");
        window.location = '/';
    });
});
