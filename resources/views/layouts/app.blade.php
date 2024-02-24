<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <x-Sidebar />
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <x-Navbar />
                <!-- End of Topbar -->

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <x-Footer />
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.partials.scripts')
</body>

</html>
