jQuery('#sform').validate({
  
    rules:{
        first_name:"required",
        last_name:"required",
        email:{
            required: true,
            email: true
        },
        phone:{
            required: true,
            digits: true
        },
    },
    messages:
    {
        first_name:"Please enter your name",
        last_name:"Please enter your last name",
    
},

});