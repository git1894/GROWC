<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for template
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\TicketsImapRepository;
use Log;

class Test extends Controller {

    public function __construct() {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        //admin
        $this->middleware('adminCheck');
    }

    /**
     * Category Table Column Mapping
     * These are additional columns in the category table that are used for tickets
     *    -------------------------------------------
     *    imap_status              - category_meta_4
     *    email                    - category_meta_5
     *    username                 - category_meta_6
     *    password                 - category_meta_7
     *    host                     - category_meta_8
     *    port                     - category_meta_9
     *    encryption               - category_meta_10
     *    post_action              - category_meta_11
     *    mailbox_id               - category_meta_12
     *    last_fetched_mail_id     - category_meta_13
     *    fecthing_status          - category_meta_14
     *    last_fetched_timestamp   - category_meta_22
     *    last_fetched_date        - category_meta_2
     *    last_fetched_count       - category_meta_23
     *    email_total_count        - category_meta_24
     *    -------------------------------------------
     *
     */
    public function index(TicketsImapRepository $repo) {

        //reset existing account owner
        \App\Models\Category::where('category_meta_14', 'processing')
            ->update(['category_meta_14' => 'completed']);

        //get just one category. the one with the oldest 'last_fetched_date'
        if (!$category = \App\Models\Category::where('category_type', 'ticket')
            ->where('category_meta_4', 'enabled')
            ->where(function ($query) {
                $query->whereNull('category_meta_14')
                ->orWhere('category_meta_14', 'completed')
                ->orWhere('category_meta_14', '');
            })
            ->orderBy('category_meta_22', 'asc')
            ->first()) {
            return;
        }

        //the payload
        $data = [
            'limit' => 10,
            'email' => $category->category_meta_5,
            'host' => $category->category_meta_8,
            'port' => $category->category_meta_9,
            'encryption' => $category->category_meta_10,
            'username' => $category->category_meta_6,
            'password' => $category->category_meta_7,
            'post_action' => $category->category_meta_11,
            'mailbox_id' => $category->category_meta_12,
            'last_fetched_mail_id' => $category->category_meta_13,
            'last_fetched_date' => $category->category_meta_22,
        ];

        //get
        $foo = $repo->fetchEmails($data, $category);

        dd('the end');

    }

    /*
$folder = $client->getFolder('INBOX');
$messages = $folder->messages()->all()->get();

foreach ($messages as $message) {
echo $message->getSubject() . '<br />';
echo 'Attachments: ' . $message->getAttachments()->count() . '<br />';
echo $message->getHTMLBody();

//Move the current Message to 'INBOX.read'
$message->setFlag('Seen');
}
 */

}