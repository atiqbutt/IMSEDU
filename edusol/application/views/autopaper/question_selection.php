        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> Create Paper</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Selection</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
           <form class="form-horizontal form-label-left enter" action="<?php echo $base_url;?>autopaper/get_question_print" method="post" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" name="branch" class="form-control" required="true">
                            <option value="">Select Branch</option>
                          <?php       
                              foreach ($branch as $value) {
                          ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name?></option>
                  <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" name="class" class="form-control" required>
                            <option value="">Select Class</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group" id="section_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="section" name="section" class="form-control">
                            <option value="">Select Section</option>
                          </select>
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Exam <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="exam" name="exam" class="form-control">
                            <option value="">Select Exam</option>
                          </select>
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="subject" name="subject" class="form-control sub" required>
                            <option value="">Select Subject</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chapter<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="chapterpast" class="ch[]">

                          </div>
                       
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select id="level" name="level" class="form-control" required>
                            <option value="">Select Level</option>
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Difficult">Difficult</option>
                          </select>
                        </div>
                      </div>
                       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-10" for="name">Date of Paper<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-10">
                                <input type="date" name="dateofpaper" class="form-control "  >
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-5" for="name">Time<span class=" ">*</span>
                        </label>
                        <div class="col-md-2 col-sm-3 col-xs-2">
                                <input type="text" name="time" class="form-control " placeholder="Total Time"  >
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-10" for="name">Total Marks<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-2 col-xs-10">
                                <input type="number" name="totalmarks" class="form-control " placeholder="Total Marks of this paper"  >
                        </div>
                       
                      </div>
<!--start of mcq-->
                       <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Mcqs<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="mcq_tag" class="form-control" id="mcqtag" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span class="mcqtype">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-10" for="name">Mcq's<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-10">
                                <input type="number" name="mcq" class="form-control q q0 mcqqty" disabled  >
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-5" for="name">Mcq Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-3 col-xs-2">
                                <input type="number" name="mcq_marks" class="form-control m m0 mcqmarks"  disabled>
                        </div>
                      </div>
<!---end of mcqs-->


<!--start of Paragraph-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Paragraph<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="paragraph_tag" class="form-control" id="typee5" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type5">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Paragraph<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="paragraph"  class="form-control q q4 typeee5"  disabled   >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="paragraph_marks"  class="form-control  m m4 typeeemarks5"  disabled  >
                        </div>
                      </div>
<!--end of paragraph-->

<!--Start of summary-->

                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Summary<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="summary_tag" class="form-control" id="typee8" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type8">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Summary<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="summary"  class="form-control q q7 typeee8"  disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="summary_marks"  class="form-control  m m7 typeeemarks8"  disabled  >
                        </div>
                      </div>

<!--end of summary-->

<!--essay start-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Essay<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="essay_tag" class="form-control"  id="typee9" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type9">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Essay<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="essay"  class="form-control q q8 typeee9"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="essay_marks"  class="form-control  m m8 typeeemarks9"  disabled  >
                        </div>
                      </div>
<!--end of essay-->
<!--application-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Application<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="application_tag" class="form-control" id="typee7"  disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type7">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Application<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="application"  class="form-control q q6 typeee7" disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="application_marks"  class="form-control  m m6 typeeemarks7" disabled >
                        </div>
                      </div>
<!--end of application-->
<!--start of letter-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Letter<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="letter_tag" class="form-control" id="typee6" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type6">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Letter<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="letter"  class="form-control q q5 typeee6"  disabled >
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="letter_marks"  class="form-control  m m5 typeeemarks6" disabled >
                        </div>
                      </div>
<!--end of letter-->
<!--short question-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for ShortQuestion<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="short_tag" class="form-control" id="shorttag"  disabled>                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span class="shorttype">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Short Question<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="short"  class="form-control q q1 shortqty"  disabled  >
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Short Question Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="short_marks"  class="form-control  m m1 shortmarks"   disabled  >
                        </div>
                      </div>
<!--end of short-->
<!--start of long-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for long<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="long_tag" class="form-control" id="longtag" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="longtype">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Long Question<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="long"  class="form-control q q2 longqty"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Long Question Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="long_marks"  class="form-control  m m2 longmarks"  disabled  >
                        </div>
                      </div>
<!--end of long-->
<!--centerl idea-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Central Idea<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="ci_tag" class="form-control" id="typee13" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type13">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Central Idea<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="centeralidea"  class="form-control q q12 typeee13"   disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="centeralidea_marks"  class="form-control  m m12 typeeemarks13"   disabled >
                        </div>
                      </div>
<!--end centeral Idea-->
<!--start of words meanings-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Words Meanings<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="wm_tag" class="form-control" id="typee16" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type16">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Words Meanings<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="wordsmeanings"  class="form-control q q15 typeee16" disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="wordsmeanings_marks"  class="form-control  m m15 typeeemarks16"  disabled  >
                        </div>
                      </div>
<!--end of words-->
<!--start of make sentese-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Make Sentences<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="ms_tag" class="form-control" id="typee15" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type15">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Make Sentences<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="makesentence"  class="form-control q q14 typeee15"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="makesentence_marks"  class="form-control  m m14 typeeemarks15"  disabled >
                        </div>
                      </div>
  <!--end of make sentence-->
<!--poem-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Poem<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="poem_tag" class="form-control" id="typee10" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type10">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Poem<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="poem"  class="form-control q q9 typeee10"  disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="poem_marks"  class="form-control  m m9 typeeemarks10"  disabled >
                        </div>
                      </div>
<!--end of poem-->
<!--opposites-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Opposites<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="opposites_tag" class="form-control" id="typee12" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type12">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Opposites<span class=" ">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="opposites"  class="form-control q q11 typeee12"  disabled >
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="opposites_marks"  class="form-control  m m11 typeeemarks12"  disabled >
                        </div>
                      </div>
<!--end of opposites-->
<!--superlative-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Superlative<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="s_tag" class="form-control" id="typee17" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type17">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Superlative<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="adjective"  class="form-control q q16 typeee17"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="superlative_marks"  class="form-control  m m16 typeeemarks17"  disabled >
                        </div>
                      </div>
<!--end of superlative-->
<!--ideoms-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Idioms<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="ideoms_tag" class="form-control"  id="typee18" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type18">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Idioms<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="ideoms"  class="form-control q q17 typeee18"   disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="ideoms_marks"  class="form-control  m m17 typeeemarks18"  disabled  >
                        </div>
                      </div>
<!--end of ideoms-->

<!--Start of grammer-->

                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Grammar<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="grammer_tag" class="form-control"  id="typee20" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type20">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Grammar<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="grammer_question"  class="form-control q q10 typeee20"   disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="grammer_marks"  class="form-control  m m10 typeeemarks20"  disabled >
                        </div>
                      </div>

<!--Start of grammer-->

<!--starting singular plural-->

                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Singular/Plural<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="sp_tag" class="form-control"  id="typee11" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type11">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Singular/plural<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="singular"  class="form-control q q10 typeee11"   disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="singular_marks"  class="form-control  m m10 typeeemarks11"  disabled >
                        </div>
                      </div>

<!--ending singular plural-->

<!--fill in blanks-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Fill Blanks<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="fill_tag" class="form-control"  id="typee4" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type4">0 </span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fill In Blanks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="fill"  class="form-control q q3 typeee4"  disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="fill_marks"  class="form-control  m m3 typeeemarks4"  disabled >
                        </div>
                      </div>
<!--end fill in blanks-->
<!--true false-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for True/False<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="tf_tag" class="form-control" id="typee19" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type19">0</span>                       
                        </div>
                      </div>

                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">True False<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="truefalse"  class="form-control q q18 typeee19"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="truefalse_marks"  class="form-control  m m18 typeeemarks19"  disabled >
                        </div>
                      </div>
<!--true false end-->
<!--translation-->
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Translation<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="te_tag" class="form-control" id="typee14"  disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type14">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Translate Into English<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="translateintoenglish"  class="form-control q q13 typeee14"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="translateintoenglish_marks"  class="form-control  m m13 typeeemarks14"  disabled>
                        </div>
                      </div>
  <!--end of translation-->
  
   <!--masculine feminine-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Masculine/Feminine<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="mf_tag" class="form-control" id="typee21" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type21">0</span>                       
                        </div>
                      </div>

                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Masculine Feminine<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="masculine"  class="form-control q q20 typeee21"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="masculine_marks"  class="form-control  m m20 typeeemarks21"  disabled >
                        </div>
                      </div>
<!--masculine feminine end-->

<!--start of make proverb-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Proverb<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="pr_tag" class="form-control" id="typee22" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type22">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Proverb<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="pro_verb"  class="form-control q q25 typeee22"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="proverb_marks"  class="form-control  m m25 typeeemarks22"  disabled >
                        </div>
                      </div>
  <!--end of make proverb-->
  
  <!--start of make conservation-->
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Conversation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="con_tag" class="form-control" id="typee23" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type23">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Conversation<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="conversation"  class="form-control q q26 typeee23"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="con_marks"  class="form-control  m m26 typeeemarks23"  disabled >
                        </div>
                      </div>
  <!--end of make conservation-->
   <!--start of make passage-->
                      <!--<div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Passage<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="pass_tag" class="form-control" id="typee24" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type24">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Passage<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="passage"  class="form-control q q47 typeee24"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="pass_marks"  class="form-control  m m47 typeeemarks24"  disabled >
                        </div>
                      </div>-->
                      
                      <div class="item form-group"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Passage<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="pass_tag" class="form-control" id="pass_tag" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span class="passage2">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"   >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Passage<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="passage"  class="form-control q q47 passage"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="pass_marks"  class="form-control  m m47 pass_marks"  disabled >
                        </div>
                      </div>
                      
  <!--end of make passage-->

                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right ">Add</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            
                
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            EduSolutions
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/date.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>
<script>
        $(document).ready(function(){
     
            $(document).on("change","#branch",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
            
        });
    </script>
<script>
        $(document).ready(function(){
             
            $(document).on("change","#class",function(){
                var value = $(this).val();
                var branch=$("#branch").val();
                
                //$.get("<?php echo base_url(); ?>load/subjectforpaper/"+value,{},function(d){
                   // var pre = '<option value="">Select Subject</opiton>';
                    //$("#subject").html(pre+d);
                //});
                
                  $.get("<?php echo base_url(); ?>load/section/role/"+value+"/"+branch,{},function(d){
                var pre = '<option value="">Select Section</option>';
            $("#section").html(pre+d);
                });
                
           $.get("<?php echo base_url(); ?>Load/exam/"+value,{},function(data){
            var pre = "<option value=''>Select Exam</option>";
            $("#exam").html(pre+data);
          });
          
            });
            
             $(document).on("change","#section",function(){
                var c = $("#class").val();
            $("#subject_div").show(); 
            var sec=$("#section").val(); 
                     
                $.get("<?php echo base_url(); ?>load/subject/"+c+"/"+sec,{},function(d){
                    var pre = '<option value="">Select Subject</option>';
            $("#subject").html(pre+d);
                });
            });
            
        });                             
</script>
<script type="text/javascript">
 
        $('#subject').change(function(){
          var id=$('#class').val();
          var idsub=$('#subject').val();

          $.ajax({
                    url: "<?php echo base_url(); ?>load/questionagainstchpter_checkbox/"+id+"/"+idsub,
                    data: {},
                      success: function( result ) {
                     
                    $( "#chapterpast" ).html(result);
  }
});

        });
       /*=======================================Function for the total of Marks here=======================*/  
</script>

<script type="text/javascript">
      $('document').ready(function(){
        $('.enter').submit(function(e){
          e.preventDefault();
          var sum = parseInt(0);
          var b =parseInt(0);
        $('.q').each(function(i,v){
          if($('.q'+i).val()!='' && $('.m'+i).val()!='' ) {
            sum = parseInt($('.q'+i).val())*parseInt($('.m'+i).val());
            b+=sum;
          }          
      });
    $('.marks').val(b);
     $('.enter').unbind("submit").submit();
    });
}); 
</script>

<script type="text/javascript">
        $('#level').change(function(){
          $('.mcqtype').html(0);
          $('#mcqtag').attr('disabled',true);
          $('.mcqqty').attr('disabled',true);
          $('.mcqmarks').attr('disabled',true);
          $('.shorttype').html(0);
          $('#shorttag').attr('disabled',true);
          $('#pass_tag').attr('disabled',true);
           $('.passage').attr('disabled',true);
           $('.pass_marks').attr('disabled',true);
          
          $('.shortqty').attr('disabled',true);
          $('.shortmarks').attr('disabled',true);
          $('#longtype').html(0);
          $('#longtag').attr('disabled',true);
          $('.longqty').attr('disabled',true);
          $('.longmarks').attr('disabled',true);
          for ( var t =19; t >=4; t-- ) {
            $('#type'+t).html(0);
            $('#typee'+t).attr('disabled',true);
            $('.typeee'+t).attr('disabled',true);
            $('.typeeemarks'+t).attr('disabled',true);
          }
          var cl=$('#class').val();
          var branch=$('#branch').val();
          var subject=$('#subject').val();
          var level=$('#level').val();
          var ch_checked=new Array();
         $( ".ch:checked" ).each(function() {
              ch_checked.push($(this).val());
          });
          $.get("<?php echo base_url(); ?>load/questions_checked/"+cl+"/"+branch+"/"+subject+"/"+level,{ch_checked:ch_checked},function(d){
                    var res=jQuery.parseJSON(d);
                   
                    console.log(res);
                      $.each( res[3], function( i, v ){
                          $('#type'+v.type).html(v.total);
                          $('#typee'+v.type).removeAttr("disabled");
                          $('.typeee'+v.type).removeAttr("disabled");
                          $('.typeeemarks'+v.type).removeAttr("disabled");
                          $('.typeee'+v.type).attr("max",v.total);
                    });
                    //======================mcq=====================
                    if(res[0].total_mcq>0){
                     $('.mcqtype').html(res[0].total_mcq);
                     $('#mcqtag').removeAttr("disabled");
                     $('.mcqqty').removeAttr("disabled");
                     $('.mcqmarks').removeAttr("disabled");
                     $('.mcqqty').attr("max",res[0].total_mcq);
                    }
                     //=======================long=====================
                     if(res[2].total_long>0){
                     $('#longtype').html(res[2].total_long);
                     $('#longtag').removeAttr("disabled");
                     $('.longqty').removeAttr("disabled");
                     $('.longmarks').removeAttr("disabled");
                     $('.longqty').attr("max",res[2].total_long);
                      }
                      //=======================short===================
                     if(res[1].total_short>0){
                     $('.shorttype').html(res[1].total_short);
                     $('#shorttag').removeAttr("disabled");
                     $('.shortqty').removeAttr("disabled");
                     $('.shortmarks').removeAttr("disabled");
                     $('.shortqty').attr("max",res[1].total_short);
                      }
                      
                        //=======================passage===================
                    // alert(res[3].total_passage);
                     if(res[4].total_passage>0){
                     $('.passage2').html(res[4].total_passage);
                     $('#pass_tag').removeAttr("disabled");
                     $('.passage').removeAttr("disabled");
                     $('.pass_marks').removeAttr("disabled");
                     $('.passage').attr("max",res[4].total_passage);
                      }
                });
        });
</script>
  </body>
</html>