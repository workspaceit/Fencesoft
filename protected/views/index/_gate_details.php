<?php if(!empty($gates)): ?>
<table id="gate-options_tbl">
    <thead>
        <tr>
            <th class="first-th">&nbsp;</th>
            <th class="desc-th">Description</th>
            <th class="width-th">Width</th>
            <th class="height-th">Height</th>
            <!--<th>Item #</th>-->
        </tr>
    </thead>
    <tbody>
    <?php foreach ($gates as $key=>$gate):?>
        <tr>
            <td class="checkbox-column">
                <i class="icon-check"></i>
            </td>
            <td><?php echo $gate['description']?></td>
            <td><?php echo $gate['width']?></td>
            <td><?php echo $gate['height']?></td>
            <!--<td><?php echo $gate['gate_item']?> <?php echo $gate['gate_sku']?></td>-->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif;?>