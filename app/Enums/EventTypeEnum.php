<?php

namespace App\Enums;

enum EventTypeEnum: string
{
  case Academic = 'academic';
  case Cultural = 'cultural';
  case Sports = 'sports';
  case Holiday = 'holiday';
  case Other = 'other';
}
