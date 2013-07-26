$(function()
    {
        //风格搜索条弹出效果
        var Search_fg = 0 //风格下拉菜单状态 0 收起 1 打开
        var Search_jg=0//价格下拉菜单状态 0 收起 1 打开
        //点击风格
        $(".search_fg p").live('click',
            function(){ 
                if( Search_fg == 0 ){
                    Search_fg = 1                          
                    $(".search_fg").addClass("search_fga")               
                    $(".search_fg .search_display").slideDown(400);                
                }
                else if( Search_fg == 1 ){
                    Search_fg = 0              
                    $(".search_fg .search_display").slideUp(400);  
                    $(".search_fg").removeClass("search_fga")
                }
            }
        )
         //点击价格
        $(".search_jg p").live('click',
            function(){ 
                if( Search_jg == 0 ){
                    Search_jg = 1                          
                    $(".search_jg").addClass("search_jga")               
                    $(".search_jg .search_display").slideDown(400);                
                }
                else if( Search_jg == 1 ){
                    Search_jg = 0              
                    $(".search_jg .search_display").slideUp(400);  
                    $(".search_jg").removeClass("search_jga")
                }
            }
        )
        //风格底部收起按钮
        $(".ppaibottom").live('click',
            function(){ 
                Search_fg = 0             
                $(".search_fg .search_display").slideUp(400);  
                $(".search_fg").removeClass("search_fga")
            }
        )
        //价格底部收起按钮
        $(".jgaibottom").live('click',
            function(){ 
                Search_jg=0               
                $(".search_jg .search_display").slideUp(400);  
                $(".search_jg").removeClass("search_jga")
            }
        )
        //风格选择
        $(".alphabetbrand a").live('click',
            function(){             
                Search_fg = 0               
                $(".search_fg").removeClass("search_fga")               
                BrandName = $(this).attr("ref").split(",")[0];
                fgid = $(this).attr("mid").split(",")[0];      
                $(".alphabetbrand a").removeClass("alphabetbrand3")
                $(this).addClass("alphabetbrand3")
                $(".search_fg p").html(BrandName)
                $("#search_fg").val(fgid)
                $(".search_fg .search_display").slideUp(400);  
                
            }
        )

        //价格选择
        $(".alphabetbrand4 a").live('click',
            function(){             
                Search_jg = 0               
                $(".search_jg").removeClass("search_jga")               
                jgName = $(this).attr("ref").split(",")[0];
                jgmin=$(this).attr("min").split(",")[0];
                jgmax=$(this).attr("max").split(",")[0];     
                $(".alphabetbrand4 a").removeClass("alphabetbrand6")
                $(this).addClass("alphabetbrand6")
                $(".search_jg p").html(jgName)
                $("#search_jgmin").val(jgmin)
                $("#search_jgmax").val(jgmax)
                $(".search_jg .search_display").slideUp(400);  
                
            }
        )



    }
)