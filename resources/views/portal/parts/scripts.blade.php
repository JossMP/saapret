{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> --}}

<!-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>-->
{{--
    <script>
        $('#btn-toggler').click(function () {
            $(".navbar-toggler").toggleClass('hidden');
            $(".navbar-toggler").toggleClass('flex');
        });

        $(function () {
            var navigation = $("#navbar");
            var currentScroll = function(){
                var scroll = $(window).scrollTop();
                if (scroll >= 10) {
                    navigation.addClass("bg-white xl:pt-4 shadow-md");
                    navigation.removeClass("xl:pt-4 text-white");
                } else {
                    navigation.removeClass("bg-white xl:pt-4 shadow-md");
                    navigation.addClass("xl:pt-4 text-white");
                }
            };
            currentScroll();
            $(window).scroll(function () {
                currentScroll();
            });
        });
    </script> --}}
@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
