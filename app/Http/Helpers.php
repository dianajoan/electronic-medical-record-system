<?php
use App\Models\Message;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\TeamCategory;
use App\Models\Service;
// use Auth;
class Helper{
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    }

    public static function postTagList($option='all'){
        if($option='all'){
            return PostTag::orderBy('id','desc')->get();
        }
        return PostTag::has('posts')->orderBy('id','desc')->get();
    }

    public static function postCategoryList($option="all"){
        if($option='all'){
            return PostCategory::orderBy('id','DESC')->get();
        }
        return PostCategory::has('posts')->orderBy('id','DESC')->get();
    }

    public static function teamCategoryList($option='all'){
        if($option='all'){
            return TeamCategory::orderBy('id','asc')->get();
        }
        return TeamCategory::has('teams')->orderBy('id','asc')->get();
    }

    public static function portfolioServiceList($option='all'){
        if($option='all'){
            return Service::orderBy('id','desc')->get();
        }
        return Service::has('services')->orderBy('id','desc')->get();
    }

}

?>