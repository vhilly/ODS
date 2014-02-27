<table>
  <tr>
    <td>Card Holder: <?=$ch->first_name?> <?=$ch->middle_name?> <?=$ch->last_name?><br></td>
    <td>Card No: <?=$ch->card_no?></td>
  </tr>
  <tr>
    <td>Birth Date: <?=$ch->birth_date?></td>
     <td>Phone : <?=$ch->phone?></td>
  </tr>
  <tr>
    <td>Mobile : <?=$ch->mobile?></td>
    <td>Address: <?=$ch->address?></td>
  </tr>
  <tr>
    <td>Promo Mechanics: <?=$ch->card->mechanics?></td>
  </tr>
  <tr>
    <td>Expiration Date: <?=$ch->expiration_date?></td>
  </tr>
</table>
