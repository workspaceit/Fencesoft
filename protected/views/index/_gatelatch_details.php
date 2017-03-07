<?php if(!empty($gateLatchOptions)): ?>
<table id="gatelatch_tbl">
    <thead>
        <tr>
            <th class="first-th">&nbsp;</th>
            <th class="option-th">Option</th>
            <!--<th>Price</th>
            <th>Item#</th>
            <th>SKU#</th>-->
        </tr>
    </thead>
    <tbody>
    <?php foreach ($gateLatchOptions as $key=>$gateLatchOption):?>
        <tr>
            <td class="checkbox-column">
                <i class="icon-check"></i>
            </td>
            <td><?php echo $gateLatchOption['latch_option']?></td>
            <!--<td><?php echo $gateLatchOption['latch_price']?></td>
            <td><?php echo $gateLatchOption['latch_item']?></td>
            <td><?php echo $gateLatchOption['latch_sku']?></td>-->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif;?>