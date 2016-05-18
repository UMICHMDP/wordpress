<select name="<?php echo $field['name'];?>">
    <?php if( ! empty( $field['options'] ) ) foreach( $field['options'] as $name => $text ){?>
        <option value="<?php echo $name;?>" <?php selected( ! empty( $field['std'] ) && $field['std'] == $name ? 1 : 0, 1 );?>><?php echo $text;?></option>
    <?php }?>
</select>