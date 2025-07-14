
    const textareas = document.querySelectorAll('textarea');

    textareas.forEach((textarea) => {
      // Impede mais de dois espaços consecutivos
      textarea.addEventListener('input', () => {
        textarea.value = textarea.value.replace(/ {3,}/g, '  ');
      });

      // Coloca o cursor no início ao focar
      textarea.addEventListener('focus', () => {
        // Delay necessário para funcionar corretamente em alguns navegadores
        setTimeout(() => {
          textarea.setSelectionRange(0, 2);
        }, 0);
      });
    });



    const steps = document.querySelectorAll(".form-step");
    let currentStep = 0;

    function showStep(index) {
      steps.forEach((step, i) => {
        step.classList.toggle("active", i === index);
      });
    }

    function validateStep(index) {
      const fields = steps[index].querySelectorAll("input, textarea");
      for (let field of fields) {
        if (!field.checkValidity()) {
          field.reportValidity();
          return false;
        }
      }
      return true;
    }

    function nextStep() {
      if (validateStep(currentStep)) {
        currentStep++;
        showStep(currentStep);
      }
    }

    function prevStep() {
      currentStep--;
      showStep(currentStep);
    }

    document.getElementById("multiStepForm").addEventListener("submit", function (e) {
      if (!validateStep(currentStep)) {
        e.preventDefault();
      }
    });