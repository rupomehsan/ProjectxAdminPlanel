<!-- cdn JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<!-- Vendor JS Files -->
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/vendor/ckeditor5-build-classic/ckeditor.js')}}"></script>
{{--<script src="{{asset('assets/vendor/MDB5-STANDARD-UI-KIT-Free-3.10.2/js/mdb.min.js')}}"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- one signal Files-->
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "8ef14202-49c8-4fc8-83e8-efe7e9f2177a",
            safari_web_id: "web.onesignal.auto.13f7d09c-87f4-478e-9a86-b96c3b883b5b",
            notifyButton: {
                enable: true,
            },
            allowLocalhostAsSecureOrigin: true,
        });
    });
</script>
<!-- CDN JS Files-->
<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
<!--<script src="assets/vendor/iconify.min.js_3.2.0/iconify.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>
<!-- Template Main JS File -->
{{--<script src="{{asset('assets/js/toastr.js')}}"></script>--}}
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

<script>
    $(document).ready(function () {
        let token = localStorage.getItem('token') || null
        // console.log(token);
        if (!token) {
            window.location.href = "{{url('login')}}";
        }

        let userData = JSON.parse(localStorage.getItem('userData'))
        console.log(userData);
        $('#userName').text(userData.name)
        $('#userImage').attr('src',userData.image)
    })

    $('#signOut').click(function () {
        localStorage.removeItem('token')
        localStorage.removeItem('userData')
        window.location.href = "{{url('login')}}";
    })
</script>



@stack('custom-js')
</body>

</html>
