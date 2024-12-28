<?php
function formatRupiah($nominal, $prefix = null){
    return $prefix . number_format($nominal, 0, ',', '.');
}