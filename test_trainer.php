<?php
$t = App\Models\Trainer::find(30);
$r = $t->update(['academic_degree' => 'TEST123']);
echo $r ? 'OK: ' . App\Models\Trainer::find(30)->academic_degree : 'FAIL';
