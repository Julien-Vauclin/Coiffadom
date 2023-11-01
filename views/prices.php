<?php session_start(); ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div>
    <table class="priceGrid">
        <thead>
            <tr>
                <th></th>
                <th class="priceGridRow">Court</th>
                <th class="priceGridRow">Mi-long</th>
                <th class="priceGridRow">Long</th>
                <th style="padding-left: 5px;">Très long</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="priceGridRow" scope="row">Coupe + brushing</th>
                <td class="priceGridRow" contenteditable="true">26€</td>
                <td class="priceGridRow" contenteditable="true">31€</td>
                <td class="priceGridRow" contenteditable="true">35€</td>
                <td class="priceGridRow" contenteditable="true">42€</td>
            </tr>
            <tr>
                <th class="priceGridRow" scope="row">Balayage</th>
                <td class="priceGridRow" contenteditable="true">30€</td>
                <td class="priceGridRow" contenteditable="true">45€</td>
                <td class="priceGridRow" contenteditable="true">52€</td>
                <td class="priceGridRow" contenteditable="true">60€</td>
            </tr>
            <tr>
                <th class="priceGridRow" scope="row">Mèches</th>
                <td class="priceGridRow" contenteditable="true">35€</td>
                <td class="priceGridRow" contenteditable="true">52€</td>
                <td class="priceGridRow" contenteditable="true">65€</td>
                <td class="priceGridRow" contenteditable="true">90€</td>
            </tr>
            <tr>
                <th class="priceGridRow" scope="row">Coloration</th>
                <td class="priceGridRow" contenteditable="true">30€</td>
                <td class="priceGridRow" contenteditable="true">35€</td>
                <td class="priceGridRow" contenteditable="true">45€</td>
                <td class="priceGridRow" contenteditable="true">60€</td>
            </tr>
            <tr>
                <th class="priceGridRow" scope="row">Racines</th>
                <td class="priceGridRow" contenteditable="true">24€</td>
                <td class="priceGridRow" contenteditable="true">24€</td>
                <td class="priceGridRow" contenteditable="true">29€</td>
                <td class="priceGridRow" contenteditable="true">29€</td>
            </tr>
            <tr>
                <th class="priceGridRow" scope="row">Patine</th>
                <td class="priceGridRow" contenteditable="true">12€</td>
                <td class="priceGridRow" contenteditable="true">20€</td>
                <td class="priceGridRow" contenteditable="true">24€</td>
                <td class="priceGridRow" contenteditable="true">30€</td>
            </tr>
            <tr>
                <th style="padding-left: 5px;" scope="row">Coiffage</th>
                <td class="priceGridRow" contenteditable="true">16€</td>
                <td class="priceGridRow" contenteditable="true">20€</td>
                <td class="priceGridRow" contenteditable="true">24€</td>
                <td style="padding-left: 5px;" contenteditable="true">30€</td>
            </tr>
        </tbody>
    </table>
</div>
<?php require_once "components/footer.php" ?>