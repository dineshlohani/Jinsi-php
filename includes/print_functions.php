<?php
    function getPrintWorkerListForKharidIkai($kharid_ikai_profile_id=0)
    {
        $profile = KharidIkaiProfile::find_by_id($kharid_ikai_profile_id);
        if(empty($profile)){ return "";}
        $details = KharidIkaiDetails::find_by_profile_id($profile->id);
        
    }
    function getSanojakKhardIkai($profile_id=0,$sanyojak_id=0)
    {
        $sanyojak = KharidIkaiDetails::find_by_profile_id_sanyojak_id($profile_id,3);
        $sanyojak = Workers::find_by_id($sanyojak->worker_id);
        $sanyojak = $sanyojak->name;
        return $sanyojak;
    }
    function getSanojakEvaluation($profile_id=0,$sanyojak_id=0)
    {
        $sanyojak = EvaluationSamitiDetails::find_by_profile_id_sanyojak_id($profile_id,3);
        $sanyojak = Workers::find_by_id($sanyojak->worker_id);
        $sanyojak = $sanyojak->name;
        return $sanyojak;
    }
?>