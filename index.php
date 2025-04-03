<?php 
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tygodniowy Harmonogram Pracy</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <center>
    <h1>Tygodniowy Harmonogram Pracy</h1>
    
    <form id="form">
        <label for="pracownikID">Wybierz pracownika:</label>
        <select name="pracownikID" id="pracownikID">
            <option value="">Wszyscy</option>
            <?php 
            $query = "SELECT ID, Imię, Nazwisko FROM pracownicy";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['ID']}'>{$row['Imię']} {$row['Nazwisko']}</option>";
            }
            ?>
        </select> <br><br>

        <label for="data_od">Data od:</label>
        <input type="date" name="data_od" id="data_od">

        <label for="data_do">Data do:</label>
        <input type="date" name="data_do" id="data_do"> <br><br>

        <label>
        Automatyczne odświeżanie<input type="checkbox" id="auto_refresh">
        </label>

        <label>
        Wyświetlanie opisów<input type="checkbox" id="show_descriptions"> 
        </label>

        <label for="column_width">Szerokość kolumn:</label>
        <input type="number" name="columnWidth" id="column_width" value="200" min="100"> <br><br>

        <button type="submit">Filtruj</button> <br> <br>
    </form>

    <div id="harmonogram">
        <p>Ładowanie danych...</p>
    </div>
    </center>
    <div class="report-section">
        <label for="personSelect"> Wybierz osobę, dla której chcesz sporządzić raport</label>
        <select id="personSelect"></select>
        <button onclick="generateReport()">Generuj raport</button>
    </div>

    <div class="image-section">
        <input type="file" id="imageInput" accept="image/*">
    </div>

    <script>
        $(document).ready(function() {
            function loadHarmonogram() {
                var pracownikID = $('#pracownikID').val();
                var dataOd = $('#data_od').val();
                var dataDo = $('#data_do').val();
                var showDescriptions = $('#show_descriptions').is(':checked') ? 1 : 0;
                var columnWidth = $('#column_width').val();

                $.ajax({
                    url: 'fetch_data.php',
                    type: 'GET',
                    data: {
                        pracownikID: pracownikID,
                        dataOd: dataOd,
                        dataDo: dataDo,
                        showDescriptions: showDescriptions,
                        columnWidth: columnWidth
                    },
                    success: function(data) {
                        console.log("odpowiedź z serwera:", data);
                        $('#harmonogram').html(data);
                    },
                    error:function(){
                        alert("Błąd podczas łądowania danych");
                    }
                });
            }
            
            function loadPersons() {
                $.ajax({
                    url: 'fetch_persons.php',
                    type: 'GET',
                    success: function(data) {
                        $('#personSelect').html(data);
                    }
                });
            }

            $('#form').on('submit', function(e) {
                e.preventDefault();
                loadHarmonogram();
            });

            $('#auto_refresh').on('change', function() {
                if ($(this).is(':checked')) {
                    setInterval(loadHarmonogram, 5000);
                }
            });

            loadHarmonogram();
            loadPersons();
        });

        function generateReport() {
    const selectedPersonId = document.getElementById("personSelect").value;
    const selectedPersonText = document.getElementById("personSelect").options[document.getElementById("personSelect").selectedIndex].text;

    if (!selectedPersonId) {
        alert("Proszę wybrać osobę!");
        return;
    }

    $.ajax({
        url: 'fetch_schedule.php',
        type: 'GET',
        data: { pracownikID: selectedPersonId },
        success: function(response) {
            if (!response || response.length === 0) {
                alert("Brak danych harmonogramu dla wybranego pracownika!");
                return;
            }

            const imageInput = document.getElementById('imageInput');
            if (!imageInput.files.length) {
                alert("Proszę wybrać obrazek!");
                return;
            }

            const file = imageInput.files[0];
            const reader = new FileReader();
            reader.onloadend = function () {
                const imgBase64 = reader.result;

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Dodaj obrazek do PDF
                doc.addImage(imgBase64, 'JPEG', 10, 10, 50, 50);

                // Dodaj dane do PDF
                doc.setFontSize(14);
                doc.text(`Raport dla: ${selectedPersonText}`, 10, 70);
                doc.text("Harmonogram", 10, 80);

                // Przetwarzanie danych harmonogramu (odpowiedź z serwera)
                let yPosition = 90;

                // Iteracja przez dane harmonogramu
                response.forEach(function(item) {
                    const firma = item.firma;
                    const data = item.data;
                    const godzina = item.godzina;
                    const opis = item.opis || "";  // Jeśli brak opisu, to pusta wartość

                    // Dodajemy dane do PDF
                    doc.text(`Data: ${data}`, 10, yPosition);
                    doc.text(`Godzina: ${godzina}`, 10, yPosition + 10);
                    doc.text(`Firma: ${firma}`, 10, yPosition + 20);
                    if (opis) {
                        doc.text(`Opis: ${opis}`, 10, yPosition + 30);  // Dodajemy opis, jeśli istnieje
                    }

                    yPosition += 50;  // Przesuwamy pozycję Y dla kolejnych wierszy

                    // Dodajemy przerwę, jeśli tabela jest za długa
                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 10;
                    }
                });

                // Zapisujemy wygenerowany raport do pliku PDF
                doc.save(`Raport_${selectedPersonText.replace(" ", "_")}.pdf`);
            };

            reader.readAsDataURL(file);
        },
        error: function () {
            alert("Błąd pobierania harmonogramu!");
        }
    });
}
</script>
</body>
</html>
