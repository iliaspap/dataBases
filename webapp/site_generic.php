<!DOCTYPE html>
<html>
<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
</style>
    <head>
        <meta charset="utf-8">
        <meta name="description" content = "Website testing">
        <title>My First Web Page</title>
    </head>
    <body>
        <header>
            <nav>
                Εδώ μπαίνει το navigation
                <a href="https://www.google.com" target="_blank">Google</a> <!-- μπορώ να αλλάξω και στο ίδιο Website -->
            </nav>
            <h1>Body of Website</h1>
            <hr/>
        </header>
        <main>
            <h2>Πίνακας</h2>
            <table>
                <caption>Table of Numbers</caption>
                <tr>
                    <th>one</th>
                    <th>two</th>
                    <th>three</th>
                </tr>
                <tr>
                    <td>four</td>
                    <td>five</td>
                    <td>six</td>
                </tr>
            </table>
            <aside>
                Ακρούλα;;;
            </aside>
            <p style="color:blue; background-color: lightblue"><big>Εδώ</big> γράφω παραγράφους και θέλω να δω πόσο μεγάλα είναι τα γράμματα<br/>
            Αν βάλω <b>enter</b>;</p>
            <p>Εδώ βάζω την επόμενη παράγραφο</p>
            <br>
            <br>

            <span>span1</span>
            <span>span2</span>
            <div>
                div1
            </div>
            <div >
                div2
            </div>
            <form>
                <input type="text" name="Enter username">
                <input type="password" value="Enter password">
            </form>
        </main>
        <footer> Footer
        </footer>
    </body>
</html>

<!-- Άλλα tags: article, section, textarea
spans are inline containers whereas divs are block containers
input type:checkbox, radio, submit
form!!!-->
