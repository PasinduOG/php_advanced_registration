class Ajax {
    static postMethod(formData, url, callback = null) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    let response = xhr.responseText;
                    if (callback) {
                        callback(response);
                    } else {
                        alert(response);
                    }
                } else if (xhr.status !== 0) {
                    console.error('Request failed with status:', xhr.status);
                    if (callback) {
                        callback(JSON.stringify({
                            success: false,
                            errors: [`Server error (${xhr.status})`]
                        }));
                    }
                }
            }
        };
        xhr.open('POST', url, true);
        xhr.send(formData);
    }

    static getMethod(viewObject, url) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    let xhttp = xhr.responseText;
                    document.getElementById(viewObject).innerHTML = xhttp;
                }
            }
        }
        xhr.open('GET', url, true);
        xhr.send();
    }
}

export { Ajax };