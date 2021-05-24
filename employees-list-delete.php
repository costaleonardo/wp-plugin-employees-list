<?php
function employee_delete(){
    if(isset($_GET['id'])){
        global $wpdb;
        $table_name=$wpdb->prefix.'employee_list';
        $i=$_GET['id'];
        $wpdb->delete(
            $table_name,
            array('id'=>$i)
        );
        echo "Deleted";
    }
    ?>
    <?php
}
?>