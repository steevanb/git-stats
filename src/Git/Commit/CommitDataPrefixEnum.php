<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

enum CommitDataPrefixEnum: string
{
    case DATE = '#date# ';
    case AUTHOR_NAME = '#autho-name# ';
    case AUTHOR_EMAIL = '#autho-email# ';
}
