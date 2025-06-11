document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.question-form');
    const submitButton = document.querySelector('.submit-button');

    if (form && submitButton) { 
        form.addEventListener('submit', function(event) {
            const questionBlocks = document.querySelectorAll('.question-block');
            let allAnswered = true;
            let firstUnansweredQuestion = null;

            questionBlocks.forEach((block, index) => {
                const radios = block.querySelectorAll('input[type="radio"]');
                let isAnswered = false;
                radios.forEach(radio => {
                    if (radio.checked) {
                        isAnswered = true;
                    }
                });

                if (!isAnswered) {
                    allAnswered = false;
                    block.style.border = '2px solid #dc3545';
                    if (!firstUnansweredQuestion) {
                        firstUnansweredQuestion = block;
                        block.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    block.style.border = '';
                }
            });

            if (!allAnswered) {
                event.preventDefault();
                alert('Silakan jawab semua pertanyaan sebelum Submit');
                if (firstUnansweredQuestion) {
                    const firstRadio = firstUnansweredQuestion.querySelector('input[type="radio"]');
                    if (firstRadio) {
                        firstRadio.focus();
                    }
                }
            }
        });
    }
});