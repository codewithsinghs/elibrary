<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<style>
    body {
        background-color: #F0F0F0;
    }

    table.dataTable th.dt-type-numeric,
    table.dataTable th.dt-type-date,
    table.dataTable td.dt-type-numeric,
    table.dataTable td.dt-type-date {
        text-align: center;
    }

    .card {
        margin-bottom: 1.875rem;
        background-color: #fff;
        transition: all .5s ease-in-out;
        position: relative;
        border: 0rem solid transparent;
        border-radius: 0.625rem;
        box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgba(82, 63, 105, 0.05);
        height: calc(100% - 30px);
    }

    @media only screen and (max-width: 35.9375rem) {
        .card {
            margin-bottom: 0.938rem;
            height: calc(100% - 0.938rem);
        }
    }

    .card-body {
        padding: 1.875rem;
    }

    @media only screen and (max-width: 35.9375rem) {
        .card-body {
            padding: 1rem;
        }
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #000;
        text-transform: capitalize;
    }

    .card-title--large {
        font-size: 1.5rem;
    }

    .card-title--medium {
        font-size: 1rem;
    }

    .card-title--small {
        font-size: 0.875rem;
    }

    .card-header {
        border-color: #DBDBDB;
        position: relative;
        background: transparent;
        padding: 1.5rem 1.875rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    @media only screen and (max-width: 35.9375rem) {
        .card-header {
            padding: 1.25rem 1rem 1.25rem;
        }
    }

    .card-header .date_picker {
        display: inline-block;
        padding: 0.5rem;
        border: 0.0625rem solid #DBDBDB;
        cursor: pointer;
        border-radius: .375rem;
    }

    .card-header .border-0 {
        padding-bottom: 0;
    }

    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }

    .input-group>.form-control,
    .input-group>.form-select {
        position: relative;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #777777;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #DBDBDB;
        border-radius: 0.75rem;
    }

    .input-group-lg>.form-control,
    .input-group-lg>.form-select,
    .input-group-lg>.input-group-text,
    .input-group-lg>.btn {
        padding: 0.5rem 1rem;
        font-size: 1.09375rem;
        border-radius: 0.3rem;
    }

    .input-group-sm>.form-control,
    .input-group-sm>.form-select,
    .input-group-sm>.input-group-text,
    .input-group-sm>.btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.76563rem;
        border-radius: 0.2rem;
    }

    .input-group-lg>.form-select,
    .input-group-sm>.form-select {
        padding-right: 3rem;
    }

    .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu),
    .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n + 3) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .input-group.has-validation> :nth-last-child(n + 3):not(.dropdown-toggle):not(.dropdown-menu),
    .input-group.has-validation>.dropdown-toggle:nth-last-child(n + 4) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        margin-left: -1px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }


    .page-titles {
        margin-left: 0;
        margin-right: 0;
    }

    .form-control {
        background: #fff;
        color: #6e6e6e;
        line-height: 2.4;
        font-size: 1rem;
        border-radius: 0.625rem;
    }
    .btn-primary {
        border-color: var(--primary-hover);
        background-color: var(--primary);
        color: var(--white);
    }

    .btn-primary:hover {
        border-color: var(--primary-hover);
        background-color: var(--primary-hover);
        /* color: var(--primary-hover); */
    }

    ul{
        padding-left:inherit;
    }
</style>
