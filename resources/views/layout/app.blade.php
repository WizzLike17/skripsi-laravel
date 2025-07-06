<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('aa/assets/vendor/fonts/boxicons.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('aa/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('aa/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('aa/assets/css/demo.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('aa/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('aa/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('aa/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('aa/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('aa/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layout.menu')

            <!-- Layout page -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layout.topbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- /Content -->

                    <!-- Backdrop -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- /Content wrapper -->
            </div>
            <!-- /Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- /Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('aa/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('aa/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('aa/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('aa/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('aa/assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('aa/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('aa/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('aa/assets/js/dashboards-analytics.js') }}"></script>

    <!-- GitHub Buttons (optional) -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ?
                v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('#myTable th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                const tbody = table.querySelector('tbody');
                Array.from(tbody.querySelectorAll('tr'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this
                        .asc))
                    .forEach(tr => tbody.appendChild(tr));
            })));
        });
    </script>




</body>

</html>
