@if(session('notification'))
<div id="notification" data-text="{{ session('notification') }}"></div>
<script>
    var notificationText = document.getElementById('notification').dataset.text;
    swal({
        position: 'center-center',
        icon: 'success',
        title: notificationText,
        showConfirmButton: false,
        buttons: false,
        timer: 2000
    });
</script>
@endif