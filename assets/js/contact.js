// Shift label if input not empty
$('#userName, #userEmail, #userMessage').on('input change', function (e) {
   if (e.target.value.length > 0) {
      $(this).next("label").addClass('contact_row_form_block_item_label_active')
   } else {
      $(this).next("label").removeClass('contact_row_form_block_item_label_active')
   }
});

// // Phone input validation
const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
const formBlock = document.getElementById("contact_form");
const submitBtn = document.getElementById("contact_form_submit");
const submitBtnLoader = document.querySelector(".contact_row_form_block_submit_loader");

const formRow = document.querySelector(".contact_row_form_block_row");
// Form fields
const userName = document.getElementById("userName");
const userEmail = document.getElementById("userEmail");
const userTextArea = document.getElementById("userMessage");
// Form labels
const userNameLabel = document.getElementById("name_label");
const userEmailLabel = document.getElementById("email_label");
const userTextLabel = document.getElementById("review_label");

const ERRORMESSAGE1 = document.getElementById('input_errorMessage1');
const ERRORMESSAGE2 = document.getElementById('input_errorMessage2');
const ERRORMESSAGE3 = document.getElementById('input_errorMessage3');

// Submit window
const onSubmitSuccessModal = document.getElementById("contact_row_form_success");
const onSubmitSuccessModalBall = document.getElementById("contact_row_form_success_ball");

// Is can submit
let isUserName = false;
let isUserEmail = false;
let isUserMessage = false;
let isCanSubmit = false;

// Colors
const defaultBorderColor = "#ccc";
const defaultTextColor = "#212322";
const errorBorderColor = "#d0021b";
const errorTextColor = "#d0021b";

// Add margin if error
function toggleMargin(isAdd) {
   if (isAdd) {
      formRow.style.marginBottom = '50px';
   } else {
      formRow.style.marginBottom = '20px';
   }
}

// Check name field
function updateName() {
   if (userName.value.length > 1) {
      userName.style.borderColor = defaultBorderColor;
      userNameLabel.style.color = defaultTextColor;
      userName.addEventListener("blur", () => {
         userName.style.borderColor = defaultBorderColor;
         userNameLabel.style.color = defaultTextColor;
      });
      toggleMargin(false)
      ERRORMESSAGE1.style.display = 'none';
      isCanSubmit = true;
      isUserName = true;
   } else {
      toggleMargin(true)
      ERRORMESSAGE1.style.display = 'block';
      userName.style.borderColor = errorBorderColor;
      userNameLabel.style.color = errorTextColor;
      isCanSubmit = false;
      isUserName = false;
   }
}

function validateEmail(value) {
   return EMAIL_REGEXP.test(value);
}
// Email validate
function updateEmail() {
   if (validateEmail(userEmail.value)) {
      userEmail.style.borderColor = defaultBorderColor;
      userEmailLabel.style.color = defaultTextColor;
      userEmail.addEventListener("blur", () => {
         userEmail.style.borderColor = defaultBorderColor;
         userEmailLabel.style.color = defaultTextColor;
      });
      toggleMargin(false)
      ERRORMESSAGE2.style.display = 'none';
      isCanSubmit = true;
      isUserEmail = true;
   } else {
      toggleMargin(true)
      ERRORMESSAGE2.style.display = 'block';
      userEmail.style.borderColor = errorBorderColor;
      userEmailLabel.style.color = errorTextColor;
      isCanSubmit = false;
      isUserEmail = false;
   }
}

// Check user message
function updateTextArea() {
   if (userTextArea.value.length > 4) {
      userTextArea.style.borderColor = defaultBorderColor;
      userTextLabel.style.color = defaultTextColor;

      userTextArea.addEventListener("blur", () => {
         userTextArea.style.borderColor = defaultBorderColor;
         userTextLabel.style.color = defaultTextColor;
      });
      ERRORMESSAGE3.style.display = 'none';
      isCanSubmit = true;
      isUserMessage = true;
   } else {
      ERRORMESSAGE3.style.display = 'block';
      userTextArea.style.borderColor = errorBorderColor;
      userTextLabel.style.color = errorTextColor;
      isCanSubmit = false;
      isUserMessage = false;
   }
}

// Submit
const submitHandler = () => {
   const isCanSubmit = isUserEmail === true && isUserMessage === true && isUserMessage === true;
   if (isCanSubmit === true) {
      const submit = {
         userName: userName.value,
         userEmail: userEmail.value,
         userMessage: userTextArea.value,
      };

      userName.value = "";
      userEmail.value = "";
      userTextArea.value = "";
      // Reset label
      const currentContactForm = $('.contact_row_form').height();
      $('.contact_row_form').height(currentContactForm);
      console.log(currentContactForm);
      $('.contact_row_form_block_item_label').removeClass('contact_row_form_block_item_label_active')

      $('#contact_form_submit').addClass('contact_row_form_block_submit_success')
      submitBtn.style.color = '#001F48';

      submitBtnLoader.style.visibility = "visible";
      submitBtnLoader.style.opacity = "1";

      setTimeout(() => {
         submitBtnLoader.style.visibility = "hidden";
         submitBtnLoader.style.opacity = "0";
      }, 1400);
      // Show success window
      setTimeout(() => {
         onSubmitSuccessModal.style.visibility = "visible";
         onSubmitSuccessModal.style.opacity = "1";
      }, 2000);
      setTimeout(() => {
         submitBtn.style.animationDirection = 'reverse';
      }, 2000);
      setTimeout(() => {
         onSubmitSuccessModal.style.visibility = "hidden";
         onSubmitSuccessModal.style.opacity = "0";
      }, 5400);

      setTimeout(() => {
         $('#contact_form_submit').removeClass('contact_row_form_block_submit_success')
         submitBtn.style.animationDirection = 'normal';
         submitBtn.style.color = 'white';
         $('.contact_row_form').height('fit-content');

      }, 7000);

      $.ajax({
         type: "POST",
         url: "/functions/send_contact_form.php",
         data: {
            submit: submit,
         },
         success: function (data) {
            console.log(data);
            // Clear inputs
            userName.value = "";
            userEmail.value = "";
            userTextArea.value = "";

            onSubmitSuccessModal.style.visibility = "visible";
            onSubmitSuccessModal.style.opacity = "1";
            setTimeout(() => {
               onSubmitSuccessModal.style.visibility = "hidden";

               onSubmitSuccessModal.style.opacity = "0";
            }, 5000);
         },
      });
   } else {
      !isUserName && updateName(true);
      !isUserEmail && updateEmail(true);
      !isUserEmail && updateTextArea(true);
   }
};
formBlock.addEventListener("keydown", (event) => {
   if (event.keyCode === 13) {
      event.preventDefault();
      userName.addEventListener("input", updateName());
      userEmail.addEventListener("input", updateEmail());
      userTextArea.addEventListener("input", updateTextArea());
      submitHandler(event);
   }
});

submitBtn.addEventListener("click", (event) => {
   event.preventDefault();
   userName.addEventListener("input", updateName());
   userEmail.addEventListener("input", updateEmail());
   userTextArea.addEventListener("input", updateTextArea());
   submitHandler(event);
});