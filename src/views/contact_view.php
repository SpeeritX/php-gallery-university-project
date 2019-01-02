<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.inc.php"; ?>
	<link rel="stylesheet" href="static/css/contact.css" />
	<link rel="stylesheet" href="static/css/form.css" />
	<script src="static/js/statue-script.js"></script>
</head>
<body>
    <?php include "includes/header.inc.php"; ?>
	<main>
		 <div class="container">
            <section>
                <h2>Formularz kontaktowy</h2>
                <form>
                    <select required>
                        <option value="" selected="selected">Cel kontaktu</option>
                        <option value="pytanie">Pytanie</option>
                        <option value="zagloszenie-bledu">Zgłoszenie błędu</option>
                        <option value="inny">Inny</option>
                    </select>

                    <input class="small-field" type="text" name="imie" placeholder="Imię" required />
                    <input class="small-field" type="text" name="nazwisko" placeholder="Nazwisko" required />
                    <input class="small-field" type="email" name="e-mail" placeholder="E-mail" required />
                    <input class="small-field" type="tel" name="telefon" placeholder="Telefon" />
                    <input type="text" name="temat" placeholder="Temat" required />

                    <textarea name="tresc" placeholder="Treść" required></textarea>

                    <input class="checkbox" type="checkbox" name="regulamin" required /> <div class="checkbox-description">
                        Wyrażam zgodę na przetwarzanie moich danych osobowych.
                        <div class="data-info" id="data-popup">
                            <h3>Zasady przetwarzania danych osobowych</h3><br />
                            Wysyłając wiadomość za pomocą formularza kontaktowego wyrażam zgodę na przetwarzanie moich danych osobowych przez XXX.<br />
                            Dane będą przetwarzane do udzielenia odpowiedzi na wysłane zapytanie. Dane przechowywane są przez  XXX i nie udostępniane firmom trzecim. Osobie której dane dotyczą przysługuje prawo dostępu do treści swoich danych oraz ich poprawiania.<br />
                            W celu ponownego wyświetlenia tego okna wystraczy w dowolnym momencie najechać myszką na “przetwarzanie moich danych osobowych.”
                        </div>
                    </div>

                    <input class="button" type="submit" value="submit" />
                    <input class="button" type="reset" value="reset" />
                </form>
            </section>
        </div>
	</main>
    <?php include "includes/footer.inc.php"; ?>
</body>
</html>
