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
                                <input type="text" name="time" class="form-control "   >
                        </div>
                      </div>
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
                                <input type="number" name="sigular"  class="form-control q q10 typeee11"   disabled >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="singular_marks"  class="form-control  m m10 typeeemarks11"  disabled >
                        </div>
                      </div>
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
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Centeral Idea<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="ci_tag" class="form-control" id="typee13" disabled  >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type13">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Centeral Idea<span class=" ">*</span>
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
                                <input type="number" name="superlative"  class="form-control q q16 typeee17"  disabled  >
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Marks<span class=" ">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="superlative_marks"  class="form-control  m m16 typeeemarks17"  disabled >
                        </div>
                      </div>
                      <div class="item form-group"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tag Line for Ideoms<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="ideoms_tag" class="form-control"  id="typee18" disabled >                       
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <span id="type18">0</span>                       
                        </div>
                      </div>
                      <div class="item form-group row1"  >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ideoms<span class=" ">*</span>
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
                      
                      <input type="hidden" class="marks" name="totalmarks">
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
                $.get("<?php echo base_url(); ?>load/subjectforpaper/"+value,{},function(d){
                    var pre = '<option value="">Select Subject</opiton>';
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
         
</script>
//=======================================Function for the total of Marks here=======================
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
//=======================================Validation=================================
<script type="text/javascript">
        $('#level').change(function(){
          $('.mcqtype').html(0);
          $('#mcqtag').attr('disabled',true);
          $('.mcqqty').attr('disabled',true);
          $('.mcqmarks').attr('disabled',true);
          $('.shorttype').html(0);
          $('#shorttag').attr('disabled',true);
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
                });
        });
</script>
  </body>
</html>