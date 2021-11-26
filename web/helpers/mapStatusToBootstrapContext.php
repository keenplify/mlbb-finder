<?php

function mapStatusToBootstrapContext($status) {
  if ($status == "OPEN") $context = "primary";
  else if ($status == "PENDING") $context = "warning";
  else if ($status == "RESOLVED") $context = "success";
  else $context = "dark"; //CLOSED

  return $context;
}