$(document).ready(function() {
    $(".description-yo__msebenzi").children("ul, ol").addClass("jb-list");

    $("#hand").click(function(e) {
        $(".show-input").css("display", "block");
        $("#ngesandla").removeClass("collapse");
        $("#website").addClass("collapse");
        $("#email_address").addClass("collapse");
    })
    $("#email").click(function(e) {
        $(".show-input").css("display", "block");
        $("#email_address").removeClass("collapse");
        $("#ngesandla").addClass("collapse");
        $("#website").addClass("collapse");
        $("#cke_ngesandla").addClass("collapse");
    })
    $("#web").click(function(e) {
        $(".show-input").css("display", "block");
        $("#website").removeClass("collapse");
        $("#ngesandla").addClass("collapse");
        $("#email_address").addClass("collapse");
        $("#cke_ngesandla").addClass("collapse");
    })
    $("#hayi_andisebenzi").click(function(e) {
        $("#gqibe_nini, #reason").removeClass("collapse");
    })
    $("#ewe_ndiyasebenza").click(function(e) {
        $("#gqibe_nini, #reason").addClass("collapse");
    })
    $('.modal').on('shown.bs.modal', function () {
        let editArea = $('.show').find('.edit-area');
        let strLen = editArea.val().length * 2
        editArea.focus();
        editArea[0].setSelectionRange(strLen, strLen);
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
});

const urlPathArray = location.pathname.split("/");
let deleteEmployer = document.getElementById('deleteEmployer');
deleteEmployer.addEventListener('click', function() {
    // confirm('Are you sure?')
})

// Edit umbuzo
document.querySelectorAll('.edit-umbuzo').forEach(item => {
    item.addEventListener('click', (e) => {
        let splitId = item.id.split('-');
        let modalId = 'editModal-' + splitId[1];
        let umbuzoId = splitId[1];
        let mod = document.getElementById(modalId);
        let saveEdit = mod.children[0].children[0].children[1].children[1].children[2];
        let editAreaId = mod.children[0].children[0].children[1].children[0].children[0].id;
        let errMessage = mod.children[0].children[0].children[1].children[1].children[0];
        item.classList.add('d-none');

        // Prevent the default event of the edit-umbuzo link 
        e.preventDefault();

        // Select card lombuzo parent
        let itemParentElement =  item.parentElement;
        let itemParentElementParent = itemParentElement.parentElement;
        let umbuzoCardParent = itemParentElementParent.parentElement;
        let umbuzoText = umbuzoCardParent.children[1].children[0].innerText;
        
        // Textarea on modal
        let editedText;
        let textArea = document.getElementById(editAreaId);
        textArea.innerText = umbuzoText;

        // When user types/edit umbuzo on modal
        textArea.addEventListener('keyup', function() {
            if(textArea.value.length < 50) {
                saveEdit.disabled = true;
                errMessage.innerText = 'Umbuzo wakho mfutshane.';
                editedText = textArea.value;
            } else {
                errMessage.innerText = '';
                saveEdit.disabled = false;

                errMessage.innerText = '';
                saveEdit.disabled = false;
                editedText = textArea.value;
                textArea.innerText = textArea.value;

                // User clicks save edit button on modal
                saveEdit.addEventListener('click', function() {
                    if(document.querySelector('.d-none')) {
                        item.classList.remove('d-none');
                    }
                    
                    // When umbuzo text has been edited with new words
                    if(umbuzoText !== editedText.trim()) {
                    
                        // Update umbuzo on the front and back end
                        let formdata = new FormData();
                        formdata.append('umbuzo', editedText);
                        formdata.append('umbuzo_id', umbuzoId);
                    
                        const ajax = new XMLHttpRequest();
                        ajax.open("POST", "/new/imibuzo/update", true);
                        ajax.onreadystatechange = function() {
                            if(ajax.readyState === 4 && ajax.status === 200) {
                                if(ajax.statusText !== 'OK') {
                                    'ikhona into erongo eyenzekileyo. Please try again.';
                                }
                            }
                        }
                        // send edited umbuzo text to the database
                        ajax.send(formdata);
                    }
                    // Update umbuzo text on the umbuzo card on the front end
                    umbuzoCardParent.children[1].children[0].innerText = editedText;
                })
            }
        });

        // User clicks save edit button on modal
        saveEdit.addEventListener('click', function() {
            if(document.querySelector('.d-none')) {
                item.classList.remove('d-none');
            }
        });
        // When user cancels editing umbuzo
        document.querySelectorAll('.cancel').forEach(item => {
            item.addEventListener('click', function() {
                if(document.querySelector('.d-none')) {
                    document.querySelector('.d-none').classList.remove('d-none');
                }
                
            });
        });
    });
});

function delay(fn, ms) {
    let timer = 0
    return function(...args) {
      clearTimeout(timer)
      timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
  }

if ( urlPathArray.includes("testimonials") ) {
      // Edit testimonial
  document.querySelectorAll('.edit-testimonial').forEach(item => {
    //Get parent element with class .card-lo-msebenzi
    //Remove border of last one if < 15
        let test = document.querySelectorAll('.card-lo-msebenzi');
        let i = test.length - 1;
        if(i < 15) {
            test[i].classList.add('border-bottom-0');
        }

      //When edit has been clicked
      item.addEventListener('click', (e) => {
          let splitId = item.id.split('-');
          let modalId = 'editModal-' + splitId[1];
          let testimonialId = splitId[1];
          let mod = document.getElementById(modalId);
          let saveEdit = mod.children[0].children[0].children[1].children[1].children[2];
          let editAreaId = mod.children[0].children[0].children[1].children[0].children[0].id;
          let errMessage = mod.children[0].children[0].children[1].children[1].children[0];
          item.classList.add('d-none');
  
          // Prevent the default event of the edit-testimonial link 
          e.preventDefault();
  
          // Select card lombuzo parent
          let itemParentElement =  item.parentElement;
          let itemParentElementParent = itemParentElement.parentElement;
          let testimonialCardParent = itemParentElementParent.parentElement;
          let testimonialText = testimonialCardParent.children[1].children[0].innerText;
          
          // Textarea on modal
          let editedText;
          let textArea = document.getElementById(editAreaId);
          textArea.innerText = testimonialText;
  
          // When user types/edit testimonial on modal
          textArea.addEventListener('keyup', function() {
              if(textArea.value.length < 50) {
                  saveEdit.disabled = true;
                  errMessage.innerText = 'Testimonial Yakho imfutshane.';
                  editedText = textArea.value;
              } else {
                  errMessage.innerText = '';
                  saveEdit.disabled = false;
  
                  errMessage.innerText = '';
                  saveEdit.disabled = false;
                  editedText = textArea.value;
                  textArea.innerText = textArea.value;
  
                  // User clicks save edit button on modal
                  saveEdit.addEventListener('click', function() {
                      if(document.querySelector('.d-none')) {
                          item.classList.remove('d-none');
                      }
                      
                    //   When testimonial text has been edited with new words
                      if(testimonialText !== editedText.trim()) {
                      
                          // Update testimonial on the front and back end
                          let testimonialData = new FormData();
                          testimonialData.append('testimonial', editedText);
                          testimonialData.append('testimonial_id', testimonialId);
                      
                          const xhttp = new XMLHttpRequest();
                          xhttp.open("POST", "/new/testimonials/update", true);
                            //Display the key/value pairs
                            // for (var pair of testimonialData.entries()) {
                            //     console.log(pair[0]+ ', ' + pair[1]); 
                            // }

                          xhttp.onreadystatechange = function() {
                              if(xhttp.readyState === 4 && xhttp.status === 200) {
                                  if(xhttp.statusText !== 'OK') {
                                      'ikhona into erongo eyenzekileyo. Please try again.';
                                  }
                              }
                          }
                          // send edited testimonial text to the database
                          xhttp.send(testimonialData);
                      }
                    //   Update testimonial text on the testimonial card on the front end
                      testimonialCardParent.children[1].children[0].innerText = editedText;
                  })
              }
          });
        // User clicks save edit button on modal
        saveEdit.addEventListener('click', function() {
            if(document.querySelector('.d-none')) {
                item.classList.remove('d-none');
            }
        });
          // When user cancels editing testimonial
          document.querySelectorAll('.cancel').forEach(item => {
              item.addEventListener('click', function() {
                  if(document.querySelector('.d-none')) {
                      document.querySelector('.d-none').classList.remove('d-none');
                  }
                  
              });
          });
      });
  });
}

if ( urlPathArray.includes("imibuzo") ) {
    // Phendula umbuzo
    let dateToday = new Date();
    let months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    window.onload = function() {
        let impendulo = document.activeElement.outerHTML;
        let phendula = document.getElementById('cke_1_contents').firstChild.contentDocument;
        phendula = phendula.body;
        phendula.addEventListener('input', delay(function(e) {
            impendulo = phendula.value;
        }, 100));
    };


    // Submit impendulo
    document.getElementById('phendula-btn').addEventListener('click', (e) => {
        e.preventDefault();
        const commentingUser = document.querySelector('.commenting-user');
        const username = commentingUser.dataset.username;
        let id_yomntu = document.querySelector('.commenting-user').id;
        const id_yombuzo = commentingUser.dataset.post;
        let commentCard = `<div class="card comment-card">
            <div class="responder-box">
                <div class="comment-avatar">BM</div>
                <div class="card-header pb-2 ml-3">
                    <h5>${username}</h5>
                    <span class="timeline-date">${dateToday.getDate()} ka  ${months[dateToday.getMonth()]}  ${dateToday.getFullYear()}</span>
                    <div class="card-body">
                        <p>${impendulo}</p>
                    </div>
                </div>
            </div>
            </div>`;
        let submitData = new FormData();
        submitData.append('impendulo', impendulo);
        submitData.append('id_yombuzo', id_yombuzo);
        submitData.append('id_yomntu', id_yomntu);
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/new/imibuzo/update", true);
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState === 4 && xhttp.status === 200) {
                document.querySelector('.comments-container').insertAdjacentHTML('beforeend', commentCard);
                let noComments = document.querySelectorAll('.no-comments');
                noComments.forEach(item => {
                    item.classList.remove('d-none');
                });
                if(document.getElementById('no-comment')) {
                    document.getElementById('no-comment').classList.add('d-none');
                }
                phendula.value = '';
                if(xhttp.statusText !== 'OK') {
                    'ikhona into erongo eyenzekileyo. Please try again.';
                }
            }
        }
        xhttp.send(submitData);
    });
}

let employers = document.getElementById("employers");
let add = document.getElementById("add");
let formFields = document.getElementById("formFields");
let count = 0;
let pageUrl = location.href;
let fields = "";
let newRemoveCollapseClass = document.getElementsByClassName("gqibe_nini");
let usasebenza_apha = document.getElementsByClassName("usasebenza_apha");

if ( urlPathArray.includes("abantu") ) {
    document.body.classList.add("bg-light");

    if( urlPathArray.includes("cv") ) {
        let like = document.getElementById("likeCV");
        
        like.addEventListener("click", () => {
            event.preventDefault();
            let unlike = document.getElementById("far");
            unlike.classList.toggle("fas");
        })
    }

    //Show password
    if( urlPathArray.includes("login") || urlPathArray.includes("register") ) {
        let showPassword = document.getElementById("show");
        showPassword.addEventListener("click", () => {
            let password = document.getElementById("password");
            if ( password.type === "password" ) {
                password.type = "text";
            } else {
                password.type = "password";
            }
        })
        if ( urlPathArray.includes("register") ) {
            let showConfirm = document.getElementById("showConfirm");
            showConfirm.addEventListener("click", () => {
                let confirmPass = document.getElementById("confirm");
                if ( confirmPass.type === "password" ) {
                    confirmPass.type = "text";
                } else {
                    confirmPass.type = "password";
                }
            })
            
        }
        
    }
}

if ( urlPathArray.includes( "tertiaryEducation" ) || urlPathArray.includes( "experience" ) || urlPathArray.includes( "skills") ) {
    add.addEventListener("click", () => {
        count += 1
        
        /*************************
         * Work experience
         *************************/
        if ( count == 1 && urlPathArray.includes( "experience" ) ) {
            let xhttp = new XMLHttpRequest();
            xhttp.open("GET", "http://localhost/new/experience.json", true);
            xhttp.onload = function() {

                let experienceData = JSON.parse(xhttp.responseText);

                let countBlock = experienceData.length;
                let formBlock = document.getElementById("formBlock_0");
                let q = "responsibilities_" + (experienceData.length);
                const experienceFormFields = `
                <div class="form-fields" id="formBlock_${countBlock}">
                    <div class="form-group">
                        <label for="company_${countBlock}">Company: <sup class="text-danger">*</sup></label>
                        <input type="text" name="company[]" id="company_${countBlock}" class="form-control" value="" required>
                        <span class="invalid-feedback"><?php echo $data['company_err']; ?></span>
                    </div>
                    <div class="form-group" id="jobTitleGroup_${countBlock}">
                        <label for="job_title_${countBlock}">Job title: <sup class="text-danger">*</sup></label>
                        <input type="text" name="job_title[]" id="job_title_${countBlock}" class="form-control" value="" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mb-0">
                        <label for="usasebenza_apha_${countBlock}">Usasebenza apha?: <sup class="text-danger">*</sup></label>
                    </div>
                    <div class="form-group col-3 p-0" id="currentEmployer_${countBlock}">
                        <select name="usasebenza_apha[]" id="usasebenza_apha_${countBlock}" class="p-2 form-control custom-select">
                            <option class="form-control" id="ewe_ndisasebenza_apha_${countBlock}" value="Ewe">Ewe</option>
                            <option class="form-control" id="hayi_ndisasebenza_apha_${countBlock}" value="Hayi">Hayi</option>
                        </select>
                            <input class="form-check-input" type="hidden">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities_${countBlock}">Sixelele izinto obuzenza phaya: <sup class="text-danger">*</sup></label>
                        <textarea name="responsibilities[]" class="form-control" id="responsibilities_${countBlock}"></textarea>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group collapse" id="reason_${countBlock}">
                        <label for="reason_for_leaving_${countBlock}">Reason for leaving</label>
                        <input type="text" name="reason_for_leaving[]" id="reason_for_leaving_${countBlock}" class="form-control" value="">
                    </div>
                </div>`;

                addExperienceFormFields(experienceFormFields);

                function addExperienceFormFields(fields) {
                    formBlock.insertAdjacentHTML("beforebegin", fields);
                }

                let m = document.getElementById("responsibilities_" + (experienceData.length));
                let n = CKEDITOR.replace( q );
                let o = `<script>${n}</script>`;
                
                addCkEditor(o);

                function addCkEditor(x) {
                    m.insertAdjacentHTML("afterend", x);
                }

                let thisYear = new Date();
                let min_year = 1980;
                let years = {};
                let max_year = thisYear.getFullYear();

                for(let i = 0; i <= max_year - min_year; i++) {
                    years[i] = max_year - i;
                }
                
                let keys = Object.values(years);
                let start_year = `
                <div class="form-group">
                    <label for="start_year_${+ (experienceData.length)}">Uqale ngowuphi unyaka?: <sup class="text-danger">*</sup></label>
                    <div class="input-container col-3 p-0">
                        <select name="start_year[]" id="start_year_${+ (experienceData.length)}" class="p-2 form-control custom-select">`;
                
                let ugqibe_nini = `
                <div class="form-group collapse" id="gqibe_nini_${(experienceData.length)}">
                    <label for="ugqibe_nini_${(experienceData.length)}">Ugqibele nini</label>
                    <div class="input-container col-3 p-0">
                        <select name="ugqibe_nini[]" id="ugqibe_nini_${(experienceData.length)}" class="p-2 form-control custom-select">
                            <option class="form-control" value="Khetha">Khetha</option>`;
                
                keys.forEach(myFunction);
                start_year += "</select><span class='invalid-feedback'></span>";
                ugqibe_nini += "</select><span class='invalid-feedback'></span>";
                let jobTitleGroup = document.getElementById("jobTitleGroup_" + countBlock);
                let currentEmployer = document.getElementById("currentEmployer_" + countBlock);
                jobTitleGroup.insertAdjacentHTML("afterend", start_year);
                currentEmployer.insertAdjacentHTML("afterend", ugqibe_nini);
                function myFunction(value) {
                    keys = "<option class='form-control'>" + value +  "</option></div></div>";
                    start_year += keys;
                    ugqibe_nini += keys;
                }

                function check() {
                    let textArea = document.getElementsByTagName("textarea");
                    for (let i = 0; i < textArea.length; i++) {
                        let newRemoveCollapseClass = document.getElementById("gqibe_nini_" + i);
                        let usasebenza_apha = document.getElementById("usasebenza_apha_" + i)
                
                        if(usasebenza_apha.value == "Ewe") {
                            newRemoveCollapseClass.style.display = 'none';
                        }
                        
                        usasebenza_apha.addEventListener("change", () => {
                            if(usasebenza_apha.value == "Hayi") {
                            newRemoveCollapseClass.style.display = 'block'
                            } 
                            else if (newRemoveCollapseClass.style.display == 'block') {
                                newRemoveCollapseClass.style.display = 'none'
                            }
                        }, false)
                    }
                }
                check()
            }
            xhttp.send();
        }

        /*************************
         * Tertiary Education
         *************************/
        if ( count == 1 && urlPathArray.includes( "tertiaryEducation" ) ) {
            let tertiaryFields = document.getElementById("tertiaryForm");

            fields = `
            <div class="form-fields bg-white pb-2" id="formFields">
            <div class="form-group">
                <label for="level_passed">Highest level passed: <sup class="text-danger">*</sup></label>
                <input id="levelPassed" type="text" name="level_passed[]" class="bg-light form-control form-control-lg " value="">
                <span id="levelError" class="invalid-feedback"></span>
            </div>
                <div class="form-group">
                    <label for="course">Igama le course: <sup class="text-danger">*</sup></label>
                    <input id="course" type="text" name="course[]" class="bg-light form-control form-control-lg">
                    <span id="courseError" class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label for="igama_lesikolo">Igama le s'kolo: <sup class="text-danger">*</sup></label>
                    <input id="tertiaryInstitution" type="text" name="institution[]" class="bg-light form-control form-control-lg">
                    <span id="institutionError" class="invalid-feedback"></span>
                </div>
            </div>`;

            addTertiaryFields(fields);

            function addTertiaryFields(x) {
                formFields.insertAdjacentHTML("beforebegin", x);
            }

            let thisYear = new Date();
            let min_year = 1980;
            let years = {};
            let max_year = thisYear.getFullYear();

            for(let i = 0; i <= max_year - min_year; i++) {
                years[i] = max_year - i;
            }
            
            let keys = Object.values(years);
            let text = `<div class="form-group">
            <label for="Ugqibe nini">Ugqibe nini: <sup class="text-danger">*</sup></label>
            <div class="input-container col-3 p-0" id="demo"><select name='year_passed[]' class='bg-light p-2 form-control custom-select'>`;
            
            keys.forEach(myFunction);
            text += "</select>";
            let demo = document.getElementById("formFields");
            demo.insertAdjacentHTML("beforeend", text);
            function myFunction(value) {
                keys = "<option class='form-control'>" + value +  "</option></div></div>";
                text += keys;
                }
                tertiaryFields.addEventListener("submit", () => {
                    let levelPassed = document.getElementById("levelPassed");
                    let course = document.getElementById("course");
                    let tertiaryInstitution = document.getElementById("tertiaryInstitution");
                    if ( levelPassed.value === "" ) {
                        levelPassed.classList.add("is-invalid");
                        let levelError = document.getElementById("levelError");
                        levelError.textContent = "Level passed?";
                        event.preventDefault() 
                    }
                    if ( course.value === "" ) {
                        course.classList.add("is-invalid");
                        let courseError = document.getElementById("courseError");
                        courseError.textContent = "Igama le course?";
                        event.preventDefault() 
                    }
                    if ( tertiaryInstitution.value === "" ) {
                        tertiaryInstitution.classList.add("is-invalid");
                        let institutionError = document.getElementById("institutionError");
                        institutionError.textContent = "Ubufunda phi?";
                        event.preventDefault() 
                    }
                
            })

        }

        /*************************
         * Skills & Competencies
         *************************/
        if ( count < 7 && urlPathArray.includes( "skills" ) ) {
             let skill = `<input type="text" name="skill[]" id="skill" class="form-control form-control-lg" autofocus>`;
             let inputFields = document.getElementById("input-group");

            addSkillsFields(skill);

            function addSkillsFields(x) {
                inputFields.insertAdjacentHTML("afterbegin", x);
            }

        }
    });
}

if ( urlPathArray.includes("employers") ) {
    let collapseList = document.querySelectorAll('.collapse.col-md-12');
    let hide = document.querySelector('.show');
    let n = hide.parentElement.children[0].children[0].children[0];
    let o = document.querySelectorAll('.btn');
    o.forEach(item => {
        item.addEventListener('click', (e) => {
            let btn = item.children[1].children[0].children[0].classList.value;
            let q = document.querySelector('.fa-minus');
            if (item.children[1].children[0].children[0].classList == "fas fa-minus") {
                item.children[1].children[0].children[0].classList = "fas fa-plus";
                console.log(item.children[1].children[0].children[0].classList);
            } else if (item.children[1].children[0].children[0].classList == "fas fa-plus") {
                item.children[1].children[0].children[0].classList = "fas fa-minus";
                console.log(item.children[1].children[0].children[0].classList);
            }
            else {
                q.classList.value = "fas fa-plus";
                console.log(q);
                console.log(btn);
                console.log(item.children[1]);
                item.children[1].children[0].children[0].classList = "fas fa-minus";
            }
        })
    })
    
    collapseList.forEach(item => {
        let faPlus = item.parentNode.querySelectorAll('.fa-plus')[0];
        if (item.classList.length == 4) {
            let accordion = item.parentNode.querySelectorAll('.btn');
            let faMinus = accordion[0].childNodes[3].childNodes[0].childNodes[0];
            faMinus.classList.value = "fas fa-minus";
            }
        if (item.classList.length == 3) {
            let accordion = item.parentNode.querySelectorAll('.btn');
            let faMinus = document.querySelector('.fa-minus');
        }
    });
}