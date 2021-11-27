<?php

function getRandomImage() {
  $path = '../img/covers';
  $files = glob($path . '/*.*');
  $file = array_rand($files);
  return $files[$file];
}