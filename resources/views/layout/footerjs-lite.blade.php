<!--ALL THIRD PART JAVASCRIPTS-->
<script src="{{ asset('vendor/js/vendor-lite.footer.js?v=' . config('system.versioning')) }}"></script>

<!--nextloop.core.js-->
<script src="{{ asset('js/core/ajax.js?v=' . config('system.versioning')) }}"></script>

<!--MAIN JS - AT END-->
<script src="{{ asset('js/core/boot-lite.js?v=' . config('system.versioning')) }}"></script>

<!--[modules] js includes-->
{!! config('js.modules') !!}