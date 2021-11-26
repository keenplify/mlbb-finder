<?php

function BadgeComponent($context, $text) {
  return "<span class='badge badge-". $context ."'>".$text."</span> ";
}