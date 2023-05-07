// Wait for the DOM to be ready
jQuery.validator.addMethod("emailCustomFormat", function (value, element) {
        return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
    });//, abp.localization.localize("Please_enter_valid_email_message"));// localized message based on current language
$(function() {
  $("form[name='voucherForm']").validate({
    // Specify validation rules
    rules: {
      start_date : "required",
      end_date : "required",
      scenario_type : "required",
      scenario_2_file:{
        required:true,
        accept:"xlsx,xls",        
    }
    },
    // Specify validation error messages
    messages: {
      start_date: "Please enter start date",
      end_date: "Please enter end date",
      scenario_type:"Please enter scenario",
      scenario_2_file:{            
        accept:"Excel is mandatory only for scenario 2",
        required:"Excel is mandatory only for scenario 2."
    }
      
    },
    errorElement: 'div',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });

});

