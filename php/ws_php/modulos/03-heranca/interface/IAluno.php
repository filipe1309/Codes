<?php
/**
 * Interface -> igual classe abstract, mas não implementa
 * os métodos, só tendo a assinatura dos mesmos.
 */
interface IAluno {
    
    public function matricular($curso);
    
    public function formar();
}

