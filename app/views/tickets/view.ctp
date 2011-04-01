
<div class="anios form">
    <p>
        <cite>
            <?php
            echo $this->data['User']['nombre']." ".$this->data['User']['apellido'];
            echo "( ".date('d-m-Y',strtotime($this->data['Ticket']['modified']))." )";
            ?>
        </cite>
    </p>
    <hr />
    <p>
        <?php
        echo $this->data['Ticket']['observacion'];
        ?>
    </p>
    
</div>