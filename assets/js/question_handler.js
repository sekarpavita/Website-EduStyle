document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('learningStyleForm');
    const submitButton = form ? form.querySelector('.submit-button') : null;

    if (form && submitButton) {
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            let totalV = 0;
            let totalA = 0;
            let totalK = 0;
            let allAnswered = true;
            let firstUnansweredQuestion = null;

            const questionBlocks = document.querySelectorAll('.question-block');
            const answers = {};

            questionBlocks.forEach((block, index) => {
                const radios = block.querySelectorAll('input[type="radio"]');
                let isAnswered = false;
                let answeredValue = null;

                radios.forEach(radio => {
                    if (radio.checked) {
                        isAnswered = true;
                        const idMatch = radio.name.match(/\[(\d+)\]/);
                        if (idMatch) {
                            const questionId = parseInt(idMatch[1]);
                            answers[questionId] = parseInt(radio.value);
                        }
                    }
                });

                if (!isAnswered) {
                    allAnswered = false;
                    block.style.border = '2px solid #dc3545';
                    if (!firstUnansweredQuestion) {
                        firstUnansweredQuestion = block;
                    }
                } else {
                    block.style.border = '';
                }
            });

            if (!allAnswered) {
                alert('Silakan jawab semua pertanyaan sebelum Submit.');
                if (firstUnansweredQuestion) {
                    firstUnansweredQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    const firstRadio = firstUnansweredQuestion.querySelector('input[type="radio"]');
                    if (firstRadio) {
                        firstRadio.focus();
                    }
                }
                return;
            }

            for (let i = 1; i <= 30; i++) {
                const value = answers[i];
                if (i >= 1 && i <= 10) {
                    totalV += value;
                } else if (i >= 11 && i <= 20) {
                    totalA += value;
                } else if (i >= 21 && i <= 30) {
                    totalK += value;
                }
            }

            const maxScorePerCategory = 10 * 5;

            const normalizedV = (totalV / maxScorePerCategory) * 100;
            const normalizedA = (totalA / maxScorePerCategory) * 100;
            const normalizedK = (totalK / maxScorePerCategory) * 100;

            try {
                const flaskApiUrl = 'http://127.0.0.1:5000/calculate_learning_style';
                
                const response = await fetch(flaskApiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        total_v: normalizedV,
                        total_a: normalizedA,
                        total_k: normalizedK
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({ message: 'No error message from server.' }));
                    throw new Error(`HTTP error! Status: ${response.status}. Message: ${errorData.message || response.statusText}`);
                }

                const data = await response.json();
                const queryString = new URLSearchParams(data).toString();
                window.location.href = `http://localhost:3000/result.php?${queryString}`;

            } catch (error) {
                console.error('Terjadi masalah dengan operasi fetch:', error);
                alert('Terjadi kesalahan saat menghitung gaya belajar. Silakan coba lagi. Detail kesalahan ada di konsol browser.');
            }
        });
    }
});