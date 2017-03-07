<?php if(!empty($PostCaps)): ?>
<table id="postcap_tbl">
    <thead>
        <tr>
            <th class="first-th">&nbsp;</th>
            <th class="style-th">Style</th>
            <th class="size-th">Size</th>
            <!--<th>Color</th>
            <th>Price</th>
            <th>ITEM#</th>
            <th>SKU#</th>-->
        </tr>
    </thead>
    <tbody>
    <?php foreach ($PostCaps as $key=>$postCap):?>
        <tr>
            <td class="checkbox-column">
                <i class="icon-check"></i>
            </td>
            <td><?php echo $postCap['post_cap_style']?></td>
            <td><?php echo $postCap['size']?></td>
            <!--<td><?php echo $postCap['color']?></td>
            <td><?php echo $postCap['price']?></td>
            <td><?php echo $postCap['item']?></td>
            <td><?php echo $postCap['sku']?></td>-->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif;?>