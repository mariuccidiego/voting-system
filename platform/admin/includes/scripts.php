<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#successToast').toast({ delay: 4000 });
        $('#successToast').toast('show');
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Ottieni il fuso orario dell'utente
        const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        console.log(userTimezone);

        // Funzione per convertire UTC a fuso orario dell'utente
        function convertUTCToUserTime(utcDateStr, timezone) {
            const utcDate = new Date(utcDateStr);
            return utcDate.toLocaleString('it-IT', { timeZone: timezone });
        }

        // Funzione per aggiornare il testo degli elementi con una classe specifica
        function updateTimeElementsByClass(className) {
            const elements = document.querySelectorAll(`.${className}`);
            elements.forEach(element => {
                const utcDateStr = element.getAttribute('data-utc');
                if (utcDateStr === "NaN" || !utcDateStr || utcDateStr=="0000-00-00 00:00:00") {
                    element.textContent = "Non Stabilita";
                } else {
                    const utcDate = utcDateStr + "Z";
                    element.textContent = convertUTCToUserTime(utcDate, userTimezone);
                }
            });
        }

        // Aggiorna gli elementi con le classi start-time ed end-time
        updateTimeElementsByClass('start-time');
        updateTimeElementsByClass('end-time');
    });
</script>