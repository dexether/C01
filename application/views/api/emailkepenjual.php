<p>
  Data Barang :
</p>
<table border="1" style="width: 100%;">
  <thead>
    <tr style="width: 100%;" align="left">
      <th>
        Nama Barang
      </th>
      <th>
        Harga
      </th>
      <th>
        Qty
      </th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <?php foreach ($datapenjual as $key => $value):
        $subtotal  = $value->prod_price * $value->qty;
        @$total = $total + $subtotal;
        ?>
          <tr>
            <td><?php echo $value->prod_alias ?></td>
            <td><?php echo $this->format->set_rp($value->prod_price) ?></td>
            <td><?php echo $value->qty ?></td>
            <td><?php echo $this->format->set_rp($subtotal) ?></td>
          </tr>
        <?php endforeach; ?>
      </tr>
      <tr>
        <td colspan="3" align="center">
          <strong>T O T A L</strong>
        </td>
        <td>
          <strong><?php echo $this->format->set_rp($total) ?></strong>
        </td>
      </tr>
      </tbody>
</table>
<br />
Data Pemesan
<?php foreach ($datapembeli as $key => $value): ?>
  <table align="" width="50%">
    <tr align="left">
      <th>Nama</th>
      <th>:</th>
      <th><?php echo $value->name; ?></th>
    </tr>
    <tr align="left">
      <th>Alamat</th>
      <th>:</th>
      <th><?php echo $value->address; ?></th>
    </tr>
    <tr align="left">
      <th>Email</th>
      <th>:</th>
      <th><?php echo $value->email; ?></th>
    </tr>
    <tr align="left">
      <th>No Telpon</th>
      <th>:</th>
      <th><?php echo $value->telephone_mobile; ?></th>
    </tr>
  </table>
<?php endforeach; ?>
<hr />
<p>
  Setelah melakukan transaksi, Pastikan anda menghubungi administrator AgendaFX untuk melakukan Konfirmasi pengiriman, Sertakan Nomor Resi.
  <br/>

  Berikut daftar alamat email admin :
  <ul style="">
  <?php foreach ($dataadmin as $key => $value): ?>
    <li><?php echo $value ?></li>
  <?php endforeach; ?>
  </ul>
</p>
