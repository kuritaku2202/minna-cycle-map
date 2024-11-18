<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReportComment;

class IncidentReportCommentController extends Controller
{
    public function index(IncidentReportComment $incidentReportComment){
        return $incidentReportComment->get();
    }
}
