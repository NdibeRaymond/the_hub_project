<?php
    #This file was created on 10-NOV-2018  :  11:49pm CAT
    #Author: Ohuoba Chimaraoke
    #File name: posts.php
    #File type: PHP
    #Description:
    /*The purpose of this script is to create, process, access and manage item posts */


    require "includes/datacontrol.php" ;
    $baseData = new Database("thehub");


    class posts{
        private $table = 'posts';
        protected $id;
        protected $name;
        protected $votes;
        protected $creator;
        protected $category;
        protected $description;
        protected $photo;
        protected $date;
        protected $baseData;

        /**
         * @return the $id
         */
        public function getId()
        {
            return $this->id;
        }

        function __construct(){
            global $baseData;
            $this->baseData = $baseData;
        }

        function formatUrlString($data){
            $data = str_replace(' ', '-', $data);
            $data = preg_replace('/[^A-Za-z0-9\-]/', '', $data);
            $data = strtolower($data);
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }



        function appendToHTML(){


            $optionHTML = '';
            foreach ($this->getPostOptions() as $postOptions){
                $optionHTML = $optionHTML.'<div class="first">
                      <div>
                      <div class="poll_card__product_name"><strong class="poll_card__option_position">'.$postOptions->getPositionString().'</strong><h5 class="poll_card__vote_count"><strong class="poll_card__vote_count_number_first">'.$postOptions->getVotes().'</strong> votes</h5></div>
                      </div>
                      <div class="poll_card__product_name">'.$postOptions->getName().'</div>
                      <div class="wd_spacerSize--5 d_spacerSize--5 wt_spacerSize--5 nt_spacerSize--5 p_spacerSize--5"></div>
                      <div class="progress" style="height: 10px;">
                        <div class="progress-bar progress-bar-success '.$postOptions->getPriorityString().'" id = "first_vote" role="progressbar" style="width:" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>';
            }

            $html = '<div class="container" style="z-index:100" >
            <div class="jumbotron shard" id = "first_vote">
            <div class="row">
            <a href="vote/'.$this->getId().'/'.$this->formatUrlString($this->getName()).'">
            <div>
              <h4>'.$this->getName().'</h4>

                <div class="poll_card__author"><span>– </span>by
                <a class="user__name" href="/profile/Nerdtality/polls"><strong>'.$this->getCreator().'</strong></a></div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                <div><img class = " img-responsive" alt="'.$this->getName().'" src="'.$this->getPhoto().'" class="responsive poll_card__img">
                <div ></div>
                <div>
                </div>
                </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="poll_card__options_heading"><h4>Options</h4></div>
                <div class="poll_card__votes">'.
                $optionHTML.'
                <button type="button" name="button"><span class="poll_card__more_options_button button button--large link_button--primary">+1 Other Option</span></button>
                </div>
                </div>
                </a>
                </div>
                </div>
                </div>';
            echo $html;
        }


        #------------------Setter functions
        function setId($id){
            $this->id = $id;
        }

        function setName($name){
            $this->name = $name;
        }

        function setVotes($votes){
            $this->votes = $votes;
        }

        function setCreator($creator){
            $this->creator = $creator;
        }

        function setCategory($category){
            $this->category = $category;
        }

        function setPhoto($photo){
            $this->photo = $photo;
        }

        function setDate($date){
            $this->date = $date;
        }



        #------------------Getter functions

        /**
        * @ this function gets a post record from database and uses the record to create a post object and returns the object
        */
        public static function getPostById($id){
            global $baseData;
            $record = $baseData->getRecordRow("posts","id",$id);
            $post = new posts();
            $post->setId($record['id']);
            $post->setName($record['name']);
            $post->setVotes($record['votes']);
            $post->setCreator($record['creator']);
            $post->setPhoto($record['photo_url']);
            $post->setCategory($record['category']);
            $post->setDescription($record['description']);
            $post->setDate($record['date']);
            return $post;



        }

        function sortItemsByVotes($a, $b){
            if ($a->getVotes() == $b->getVotes()){
                return 0;
            }
            return ($a->getVotes() < $b->getVotes()) ? 1 : -1;
        }

        public function sortPostOptions($postOptions){
            #an algorithm that sorts post options according to their number of votes
            $sortedOptions = Array();
            $votes = Array();
            $ids = Array();
            $count = 0;
            #loop through all the post option objects, get their votes and add them to $votes array
            #also for get their id an add them to $ids array for integrity check
            foreach ($postOptions as $option){
                $votes[$count] = $option->getVotes();
                $ids[$count] = $option->getId();
                $count++;
            }
            #sort the votes array in descending order of their value
            rsort($votes);
            /*loop through the $votes array, get the post option object that matches with the current vote index
             * and add it to the $sortedOptions array at current index
             */
            for ($x=0; $x<count($votes); $x++){
                foreach ($postOptions as $option){
                    #match post option with its corresponding votes and check the integrity with the id
                    if ($option->getVotes()==$votes[$x] && $option->getId()==$ids[$x]){
                        $option->setPriority($x+1); #set the priority of the option (this determines the position where the option will placed in the list of options)
                        $sortedOptions[$x] = $option; #add option to $sortedOptions
                    }
                }

            }
            # return the $sortedOptions array
            $sortedOptions = $postOptions;
            usort($sortedOptions, array($this,'sortItemsByVotes'));
            return $sortedOptions;
        }

        public function getPostOptions(){
            #this function gets a post options from the database, build them into an object and return an array of the Objects
            $options = Array();
            #read the post options from the database and store it as an array in $records
            $records = $this->baseData->getMultipleRecords('items', 'foreign_key', $this->id);
            if ($records != NULL){
                #make sure that $records data is not NULL
                #if $records is NULL that implies that there was no option for the post found in database
                $recordLength = count($records);
                for ($x=0; $x<$recordLength; $x++){
                    #loop through all the option records read from the database
                    $option = new Option(); #create a new option object
                    # $option->setSortKey('key'.rand()); //has no need for now
                    $option->setAllVars($records[$x]); #set all the properties of the option object with $records array
                    $options[$x]=$option; # add the option object to $options array
                }
                //var_dump($options);
                $options = $this->sortPostOptions($options); #sort the post options
                //var_dump($options);
                return $options;

            }else {

                #return NULL since the $records NULL (No data read from database)
                return NULL;
            }


        }


        /**
        * @return the $votes
        */
        function getName(){
            return $this->name;
        }

        /**
         * @return the $votes
         */
        public function getVotes()
        {
            return $this->votes;
        }

        /**
        * @return the $creator
        */
        public function getCreator()
        {
            return $this->creator;
        }

        /**
        * @return the $category
        */
        public function getCategory()
        {
            return $this->category;
        }

        /**
        * @return the $photo
        */
        public function getPhoto()
        {
            return $this->photo;
        }

        /**
        * @return the $date
        */
        public function getDate()
        {
            return $this->date;
        }


        #end of class

        /**
         * @return the $description
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param field_type $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }
        }




    class Option extends posts{
        private $table = 'items';
        protected $id;
        protected $name;
        protected $votes;
        protected $photo;
        protected $creator;
        protected $category;
        protected $group;
        protected $description;
        protected $key;
        protected $price;
        protected $date;
        protected $sortKey;
        protected $priority;
        protected $baseData;


        /**
         * @return the $price
         */
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * @param field_type $price
         */
        public function setPrice($price)
        {
            $this->price = $price;
        }

        /**
         * @return the $description
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param field_type $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        function __construct(){
            global $baseData;
            $this->baseData = $baseData;

        }


        /**
         * @param field_type $priority
         */
        public function setPriority($priority)
        {
            $this->priority = $priority;
        }

        #-----------Getters


        /**
         * @return the $id
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return the $name
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @return the $votes
         */
        public function getVotes()
        {
            return $this->votes;
        }

        /**
         * @return the $photo
         */
        public function getPhoto()
        {
            return $this->photo;
        }

        /**
         * @return the $creator
         */
        public function getCreator()
        {
            return $this->creator;
        }

        /**
         * @return the $category
         */
        public function getCategory()
        {
            return $this->category;
        }

        /**
         * @return the $group
         */
        public function getGroup()
        {
            return $this->group;
        }

        /**
         * @return the $key
         */
        public function getKey()
        {
            return $this->key;
        }

        /**
         * @return the $date
         */
        public function getDate()
        {
            return $this->date;
        }

        /**
         * @return the $sortKey
         */
        public function getSortKey()
        {
            return $this->sortKey;
        }


        #--------------Setters


        /**
         * @param field_type $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @param field_type $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @param field_type $votes
         */
        public function setVotes($votes)
        {
            $this->votes = $votes;
        }

        /**
         * @param field_type $photo
         */
        public function setPhoto($photo)
        {
            $this->photo = $photo;
        }

        /**
         * @param field_type $creator
         */
        public function setCreator($creator)
        {
            $this->creator = $creator;
        }

        /**
         * @param field_type $category
         */
        public function setCategory($category)
        {
            $this->category = $category;
        }

        /**
         * @param field_type $group
         */
        public function setGroup($group)
        {
            $this->group = $group;
        }

        /**
         * @param field_type $key
         */
        public function setKey($key)
        {
            $this->key = $key;
        }

        /**
         * @param field_type $date
         */
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**
         * @param field_type $sortKey
         */
        public function setSortKey($sortKey)
        {
            $this->sortKey = $sortKey;
        }

        /**
         * @sets all variables in this class with an array passed as parameter
         */
        public function setAllVars($blockData){
            $this->setId($blockData['id']);
            $this->setName($blockData['name']);
            $this->setVotes($blockData['votes']);
            $this->setCreator($blockData['creator']);
            $this->setCategory($blockData['category']);
            $this->setPhoto($blockData['photo_url']);
            $this->setGroup($blockData['item_group']);
            $this->setPrice($blockData['price']);
            $this->setDescription($blockData['description']);
            $this->setKey($blockData['foreign_key']);
            $this->setDate($blockData['date']);
        }

        public function getPriority(){
            return $this->priority;

        }

        function getVotePercentage(){
            $parentVote = $this->baseData->getRecord('posts','votes','id',$this->getKey());
            if($this->getVotes() != '0'){
                $votePercentage = ($this->getVotes()/$parentVote)*100;
            }else {
                $votePercentage = 0;
            }
            return $votePercentage;

        }

        function getPriorityString(){
            if ($this->priority == 1){
                return 'first';
            }elseif ($this->priority == 2){
                return 'second';
            }elseif ($this->priority == 3){
                return 'third';
            }elseif ($this->priority == 4){
                return 'fourth';
            }else{
                return 'fourth';
            }
        }


        function getPositionString(){
            if ($this->priority == 1){
                return '1st';
            }elseif ($this->priority == 2){
                return '2nd';
            }elseif ($this->priority == 3){
                return '3rd';
            }elseif ($this->priority == 4){
                return '4th';
            }else{
                return 'fourth';
            }
        }


        function userHasVoted(){
            $voted = FALSE;
            if (isset($_SESSION['username'])){
                $voteRecords = $this->baseData->getMultipleRecords('votes','voter',$_SESSION['username']);
                /* Check to see if $voteRecord is NULL or not, if it is NULL, that means that the has not voted in
                 * any item before, hence has no voting record in database
                 */
                //var_dump($voteRecords);
                if ($voteRecords != NULL){
                    foreach ($voteRecords as $voteRecord){
                        //echo 'running a debug loop';
                        #loop through all the voting records of the user and check if he has already voted the item
                        if ($voteRecord['option'] == $this->getId()){
                            #user has already voted this item
                            $voted = TRUE;
                        }
                    }
                }
            }
            return $voted;
        }


        public function appendHTML(){
            $voteButton = '';
            if ($this->userHasVoted()){
                $voteButton = '<a href="'.$_SERVER["PHP_SELF"].'?id='.$this->getKey().'&hash=1fad31c&vote='.$this->getId().'&option='.$this->getPriority().'" class="btn btn-outline-danger">Voted</a>';
            }else{
                $voteButton = '<a href="'.$_SERVER["PHP_SELF"].'?id='.$this->getKey().'&hash=1fad31c&vote='.$this->getId().'&option='.$this->getPriority().'" class="btn btn-primary">Vote</a>';
            }
            $html = '<div class="card" style="width:400px">
            <img class="card-img-top" src="'.$this->getPhoto().'" alt="Card image" style="width:100%">
            <div class="card-body">
            <h4 class="card-title">'.$this->getName().'</h4>
            <p class="card-text">'.$this->getDescription().'</p>
            <hr/>
            <div class="row">
            <div class="col-sm-9">
            <div class="progress" style="height:12% !important">
            <div class="progress-bar bg-success" style="width:'.$this->getVotePercentage().'%"></div>
            </div>
            </div>
            <div class="col-sm-3"><span class="badge badge-pill badge-light" style="font-size:10px">'.$this->getVotes().' votes</span></div>
            </div>
            <br>
            <div class="row">
            <div class="col-sm" style="border-right:1px solid #ccc;">'.$voteButton.'</div>
            <div class="col-sm" style="border-right:1px solid #ccc;"><center>$'.$this->getPrice().'</center></div>
            <div class="col-sm" style="border-right:1px solid #ccc;"><center><i class="far fa-bookmark" style="font-size:30px;" data-toggle="tooltip" title="Save this item"></i></center></div>
            <div class="col-sm"><center><i class="far fa-comments" style="font-size:30px;" id="comment" title="Comments"></i></center></div>
            </div>
            </div>
            </div>';
            echo $html;
        }

        public function vote(){
            $vote = $this->baseData->getRecord('items', 'votes', 'id', $this->id);
            $vote++; #increment the votes
            $success = $this->baseData->updateRecord($this->table, 'votes', $vote, 'id', $this->id);
            if ($success){
                #create a record of this vote in the votes table in database
                $success=$this->baseData->insertVotes($_SESSION['username'],$this->getKey(),$this->getId(),'1facc2341',$vote);
                if ($success){
                    #update the total votes of the corresponding post
                    $postVotes = $this->baseData->getRecord('posts','votes','id',$this->getKey());
                    $postVotes++;
                    $success=$this->baseData->updateRecord('posts', 'votes', $postVotes, 'id', $this->getKey());
                    if ($success){
                        $this->setVotes($this->baseData->getRecord('items', 'votes', 'id', $this->id));
                      return TRUE;
                    }
                    return -2;
                }
                return -2;
            }else {
                return FALSE;
            }
        }

    }


/*
    $post = posts::getPostById("1");
    //echo $post->getPostOptions()[0]->getName();
    if ($post->getPostOptions()[0]->vote()){
        echo 'voted for '.$post->getPostOptions()[0]->getName();
    }
    */











?>