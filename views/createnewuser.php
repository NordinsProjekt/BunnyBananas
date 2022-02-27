<?php $ctrlr = new UserController()?>

<h1>Skapa konto</h1>

LETS PUT SOME DRAWINGLOGIC HERE?!
<table>
<?php

foreach ($ctrlr->GetLetterArray() as $letter) { ?>

    <tr>
        <td><?php echo $letter; ?></td>
    </tr>

<?php }?>
</table>