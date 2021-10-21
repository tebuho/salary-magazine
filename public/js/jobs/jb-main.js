let emptyList = document.querySelector(".centre-scroll");
let provFilterOptions = document.getElementById("province-filter");
let prov = document.querySelectorAll(".prov-li");
let txt = "";
let prov_name = "";
let fdata = Array();
let href = window.location.href;
let ndata = new Array;

function api_req() {
    let req = new XMLHttpRequest();
    req.open("GET", "http://localhost/new/jb-all.json");
    req.onload = function() {
        let data = JSON.parse(req.responseText);
        filter_job_li(data)
        render_job_card(data);
        filter_job_prov(data)
}
req.send();
}
api_req();
function filter_job_li(data) {
    for (x = 0; x < data.length; x++) {
        const provinces = data[x].job_province
        console.log(provinces)
        const filter_li = 
        `<li>
        <input type="checkbox" class="prov-li" name="${data[x].job_province_slug}" id="${data[x].job_province_slug}" value="${data[x].job_province}">
        <label for="${data[x].job_province_slug}" class="m-0">
            ${data[x].job_province}
        </label>
    </li>`
    // provFilterOptions.innerHTML += filter_li;
    }
}
function render_job_card(data) {
    for (x = 0; x < data.length; x++) {
        const jb_crd = 
        `<div class="card-lo-msebenzi heading-container pr-0 pl-0">
            <div class="job-meta">
                <div class="job-meta_tags">
                    <span class="badge badge-light"><a href="${data[x].job_type_slug}">${data[x].job_type}</a></span>
                    <span class="badge badge-light"><a href="${data[x].job_category_slug}">${data[x].job_category}</a></span>
                </div>
                <div class="follow">
                    <a href="${href}${data[x].job_province_slug}/edit/${data[x].job_slug}" class="edit-link follow-btn">Edit</a>
                </div>
            </div>
            <div class="job-title__index">
                <div class="label">
                    <a href="${href}${data[x].job_province_slug}/umsebenzi/${data[x].job_slug}" class="umsebenzi-card__title">
                        <h6>${data[x].job_title}</h6>
                    </a>
                    <p>${data[x].job_employer} - ${data[x].job_location}, ${data[x].job_province}</p>
                </div>
            </div>
        </div>`
        emptyList.innerHTML += jb_crd;
    }
    
}

function filter_job_prov(data) {
    console.log(prov);
    for (i = 0; i <prov.length; i++) {
        let provId = prov[i].id;
        let checkBox = document.getElementById(provId);
        checkBox.addEventListener("click", event => {
            let eventTarget = event.target;
            prov_name = eventTarget.value;
            if (eventTarget.checked) {
                fdata = data.filter(el => el.job_province == prov_name)
                emptyList.innerHTML = ""
                ndata.push(fdata)
                ndata = ndata.flat()
                render_job_card(ndata)
            }
        })
    }
}
