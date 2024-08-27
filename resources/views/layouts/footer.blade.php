<!--**********************************
            Footer start
        ***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed by <a href="rntu.ac.in" target="_blank">Aisect Dev</a> {{ date('Y') }}
        </p>
    </div>
</div>
<!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
           Support ticket button start
        ***********************************-->

<!--**********************************
           Support ticket button end
        ***********************************-->


</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="{{ asset('build/assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('build/assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

<!-- Apex Chart -->
{{-- <script src="{{ asset('build/assets/vendor/apexchart/apexchart.js') }}"></script> --}}

<!-- Include additional script files -->
@stack('scripts')

<script src="{{ asset('build/assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ asset('build/assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>



<!-- Dashboard 1 -->
<script src="{{ asset('build/assets/js/dashboard/dashboard-1.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('build/assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('build/assets/vendor/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('build/assets/js/dlab.carousel.js') }}"></script>

<script src="{{ asset('build/assets/js/custom.js') }}"></script>
<script src="{{ asset('build/assets/js/dlabnav-init.js') }}"></script>
<script src="{{ asset('build/assets/js/demo.js') }}"></script>
{{-- <script src="{{ asset('build/assets/js/styleSwitcher.js') }}"></script> --}}
<script>
    $(function() {
        $('#datetimepicker').datetimepicker({
            inline: true,
        });
    });

    $(document).ready(function() {
        $(".booking-calender .fa.fa-clock-o").removeClass(this);
        $(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
    });
</script>
<!-- Include additional script files -->
@yield('scripts')
{{-- <script>
    setInterval(function() {
        $.ajax({
            url: '{{ route("update.activity.time") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Activity time updated successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error updating activity time:', error);
            }
        });
    }, 3000); // Update every 3 seconds
</script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    setInterval(function() {
        $.ajax({
            url: '/update-end-time',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('End time updated successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error updating end time:', error);
            }
        });
    }, 10000); // Update every 3 seconds
</script>

{{-- <script>
    // Function to set the body attribute based on page location
    function setBodyLayout() {
      const pathname = window.location.pathname;
      const isHomePage = pathname === '/' || pathname === '/home';
      const body = document.querySelector('body');
      body.setAttribute('data-layout', isHomePage ? 'horizontal' : 'vertical');
    }
  
    // Call the function when the page loads
    window.addEventListener('DOMContentLoaded', setBodyLayout);
  </script> --}}
</body>

</html>
