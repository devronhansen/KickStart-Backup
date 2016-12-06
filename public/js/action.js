$(document).ready(function () {
    $('.alert').delay(2000).fadeOut('slow');
    $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    $('.tbody').on('click', function () {
        tbody_clicked_id = $(this).attr("id");
        document.getElementById("date_hidden").value = tbody_clicked_id;
        loadData();

        function loadData() {
            $.ajax({
                url: '/menu',
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    var day_array = data.filter(function (data) {
                        return data['date'] === tbody_clicked_id;
                    });
                    document.getElementById("vollkost-input").value = day_array.map(function (day_array) {
                        return day_array['vollkost'];
                    });
                    document.getElementById("vegetarisch-input").value = day_array.map(function (day_array) {
                        return day_array['vegetarisch'];
                    });
                    document.getElementById("fitness-input").value = day_array.map(function (day_array) {
                        return day_array['fitness'];
                    });
                    document.getElementById("nachtisch-input").value = day_array.map(function (day_array) {
                        return day_array['nachtisch'];
                    });
                    document.getElementById('create_menu').action += day_array.map(function (day_array) {
                        return day_array['id'];
                    });
                }
            });
        }
    });

    $('#menu_Modal, #create_menu_new').on('hidden.bs.modal', function () {
        clearInterval(Interval);
    });

    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }

// Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        var scrollmem = $('html,body').scrollTop(); //get top location
        window.location.hash = e.target.hash; //switch page
        $('html,body').scrollTop(scrollmem); //scroll to top
    })
})
;
$(document).on('change', ':file', function () {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    $('.download-pic').html(label);
});
