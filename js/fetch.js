document.querySelector('#book_issue_id').addEventListener('change', function () {
    fetch_and_display_details();
});

document.querySelector('#return_date').addEventListener('change', function () {
    fetch_and_display_details();
});

function fetch_and_display_details() {
    var ibid = document.querySelector('#book_issue_id').value;
    var return_date = document.querySelector('#return_date').value;
    if (ibid !== '' && return_date !== '') {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var fetched_details = JSON.parse(this.responseText);
                
                document.querySelector('#issued_book_name').value = fetched_details.issued_book_name;
                document.querySelector('#issued_user_name').value = fetched_details.issued_user_name;

                document.querySelector('#fetched_details_container').style.display = 'block';
                document.querySelector('#calculate_fine').style.display = 'inline';

                var encoded_ibid = btoa(ibid);
                var encoded_return_date = btoa(return_date);

                document.querySelector('#calculate_fine').href = '../admin/calculate_fine.php?ibid=' + encodeURIComponent(encoded_ibid) + '&return_date=' + encodeURIComponent(encoded_return_date);
            }
        };
        xhttp.open("POST", "../admin/fetch_issue_book_info.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("ibid=" + encodeURIComponent(ibid));
    }
    else {
        document.querySelector('#fetched_details_container').style.display = 'none';
        document.querySelector('#calculate_fine').style.display = 'none';
    }
}