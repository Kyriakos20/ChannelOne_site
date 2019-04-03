<?php

$obj = json_decode($data);

?>

<html>
<head>
    <title>C1 Print App</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        h3 {
            margin:0;
        }
        table {
            font-size:10px;
            width:800px;
            text-align: left;
            border:1px solid #999;
            margin-bottom:5px;
        }
        tr {
            border:1px solid #999;
        }
        tr > td:first-child, tr > th:first-child {
            width:50%;
        }
        td,th {
            border:1px solid #999;
        }
        td.full,th.full {
            width:100%;
        }
    </style>
</head>
<body>
<h3>
    C1 HECM to HECM Application - <?php echo $obj->app->borrower->name->last.', '.$obj->app->borrower->name->first;?>
</h3>
    <table>
        <tr>
            <th>Date</th><th>LO</th>
        </tr>
        <tr>
            <td><?php echo date('m/d/Y', time());?> - Follow up on
                <?php echo (isset($obj->app->appFollowUp))?date('m/d/Y H:i:a', strtotime($obj->app->appFollowUp)):'';?>
            </td>
            <td><?php echo $obj->app->user->email;?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>C1 ID</th>
            <th>Address</th>

            
        </tr>
        <tr>
            <td>
                <?php echo $obj->app->property->oldId;?>
            </td>
            <td>
                <?php
                    echo $obj->app->property->address->street1.'<br />';
                    if(!empty($obj->app->property->address->street2))
                    {
                        echo $obj->app->property->address->street2.'<br />';
                    }
                if(!empty($obj->app->property->address->county))
                {
                    echo $obj->app->property->address->county.' County <br />';
                }

                    echo $obj->app->property->address->city.', '.$obj->app->property->address->state.' '.$obj->app->property->address->zip;


                ?>
            </td>


        </tr>
    </table>
    
    <table>
        <tr>
            <th>Phones</th><th>Emails</th>
        </tr>
        <tr>
            <td>
                <ul>
                    <?php
                    ///phones
                    $phones = array();
                    foreach($obj->app->phones as $phone)
                    {
                        $phones[] = $phone->number;
                        echo '<li>'.$phone->number.' '.$phone->description.'</li>';
                    }

                    foreach($obj->app->property->phones as $phone)
                    {
                        if(!in_array($phone->number) && $phone->status == 'Good')
                        {
                            echo '<li>'.$phone->number.' - C1</li>';
                        }
                    }


                    ?>

                </ul>
            </td>
            <td>
                <ul>
                    <?php

                    foreach($obj->app->emails as $email)
                    {

                        echo '<li>'.$email->address.' - '.$email->description.'</li>';
                    }

                    ?>

                </ul>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Borrower</th><th>Co-Borrower</th>
        </tr>
        <tr>
            <td>
                <?php
                    $name = $obj->app->borrower->name;
                    echo $name->first.' '.$name->middle.' '.$name->last.' '.$name->suffix;
                ?>
            </td>
            <td>
                <?php
                $name = $obj->app->coborrower->name;
                echo $name->first.' '.$name->middle.' '.$name->last.' '.$name->suffix;
                ?>
            </td>
        </tr>

        <tr>
            <td>
                <strong>DOB:</strong>
                <?php
                    if(isset($obj->app->borrower->dateOfBirth))
                    {
                        echo date('m/d/Y', strtotime($obj->app->borrower->dateOfBirth));
                    }
                ?>
                <br />
                <strong>SSN:</strong> <?php echo $obj->app->borrower->ssn;?>

            </td>
            <td>
                <strong>DOB:</strong>
                <?php
                if(isset($obj->app->coborrower->dateOfBirth))
                {
                    echo date('m/d/Y', strtotime($obj->app->coborrower->dateOfBirth));
                }
                ?>
                <br />
                <strong>SSN:</strong> <?php echo $obj->app->coborrower->ssn;?>

            </td>
        </tr>

        <tr>
            <th>Income</th><th>Income</th>
        </tr>
        <tr>
            <td>
                <ul>
                    <?php foreach($obj->app->borrower->incomes as $income):?>
                        <li>
                            <?php echo $income->amount;?> - <?php echo $income->source;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </td>
            <td>
                <ul>
                    <?php foreach($obj->app->coborrower->incomes as $income):?>
                    <li>
                        <?php echo $income->amount;?> - <?php echo $income->source;?>
                    </li>
                    <?php endforeach;?>
                </ul>
            </td>
        </tr>

        <tr>
            <th>Assets</th><th>Assets</th>
        </tr>
        <tr>
            <td>
                <ul>
                    <?php foreach($obj->app->borrower->assets as $income):?>
                        <li>
                            <?php echo $income->amount;?> - <?php echo $income->source;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </td>
            <td>
                <ul>
                    <?php foreach($obj->app->coborrower->assets as $income):?>
                        <li>
                            <?php echo $income->amount;?> - <?php echo $income->source;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </td>
        </tr>


    </table>

    <table>
        <tr>
            <th>Credit</th><th></th>
        </tr>
        <tr>
            <td>
                <strong>RATING:</strong>
                <?php
                    $rating = $obj->app->credit->rating;
                ?>
                <input type="radio" value="Poor" name="rating" <?php echo ($rating == 'Poor'?'checked':'');?>> Poor
                <input type="radio" value="Fair" name="rating" <?php echo ($rating == 'Fair'?'checked':'');?>> Fair
                <input type="radio" value="Good" name="rating" <?php echo ($rating == 'Good'?'checked':'');?>> Good
                <input type="radio" value="Great" name="rating" <?php echo ($rating == 'Great'?'checked':'');?>> Great
                <br />
                <strong>SCORE:</strong>
                <?php
                echo $obj->app->credit->score;
                ?>
                <br />
                <strong>30 day late payment on CC or Loans in last 2 yrs?</strong><br />
                <?php
                echo $obj->app->credit->lates;
                ?>
            </td>
            <td>
                <strong>Lapses in Homeowner's Insurance in last 12 months?</strong><br />
                <?php
                echo $obj->app->credit->insuranceLates;
                ?>
                <br />
                <strong>Problems paying property taxes in last 2 yrs?</strong><br />
                <?php
                echo $obj->app->credit->taxLates;
                ?>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Mortgage Statement</th><th></th>
        </tr>
        <tr>
            <td>
                <strong>CURRENT BANK: </strong> <?php echo $obj->app->loan->bank;?><br />
                <strong>YEAR TAKEN: </strong> <?php echo $obj->app->loan->year;?><br />
                <strong>CURRENT BALANCE: </strong> <?php echo $obj->app->loan->balance;?><br />
                <strong>STATEMENT DATE: </strong>
                <?php if(isset($obj->app->loan->date)):?>
                 <?php echo date('m/d/Y', strtotime($obj->app->loan->date));?>
                <?php endif;?>
            </td>
            <td>
                <strong>ORIG PRINC LIMIT: </strong> <?php echo $obj->app->loan->originalPrincipleLimit;?><br />
                <strong>GROWTH: </strong> <?php echo $obj->app->loan->growth;?><br />
                <strong>RATE: </strong> <?php echo $obj->app->loan->rate;?><br />
                <strong>TYPE: </strong> <?php echo $obj->app->loan->type;?>
            </td>
        </tr>
        <tr>
            <th>Line of Credit</th><th>Taking Payment</th>
        </tr>
        <tr>
            <td>
                <strong>HAVE A LINE: </strong> <?php echo $obj->app->loan->lineOfCredit->available;?><br />
                <strong>AMOUNT: </strong> <?php echo $obj->app->loan->lineOfCredit->amount;?><br />
                <strong>NUMBER: </strong> <?php echo $obj->app->loan->lineOfCredit->number;?>
            </td>
            <td>
                <strong>AVAILABLE: </strong> <?php echo $obj->app->loan->takingPayment->available;?><br />
                <strong>AMOUNT/MONTH: </strong> <?php echo $obj->app->loan->takingPayment->amountPerMonth;?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Home Info</th><th></th>
        </tr>
        <tr>
            <td>
                <strong>OLD VALUE: </strong> <?php echo $obj->app->home->oldValue;?><br />
                <strong>CLIENT ESTIMATE: </strong> <?php echo $obj->app->home->clientEstimate;?><br />
                <strong>ZILLOW: </strong> <?php echo $obj->app->home->zestimate;?><br />
                <strong># BEDS ABOVE GROUND: </strong> <?php echo $obj->app->home->bedrooms;?><br />
                <strong># BATHROOMS: </strong> <?php echo $obj->app->home->bathrooms;?>
            </td>
            <td>

                <strong># STORIES: </strong> <?php echo $obj->app->home->stores;?><br />
                <strong>SQUARE FEET: </strong> <?php echo $obj->app->home->squareFeet;?><br />
                <strong>TYPE OF HOME: </strong> <?php echo $obj->app->home->type;?><br />
                <strong>YEAR BUILT: </strong> <?php echo $obj->app->home->yearBuilt;?><br />
                <strong>ACRES: </strong> <?php echo $obj->app->home->acres;?>
            </td>
        </tr>

        <tr>
            <th>Homeowners Assoc</th><th>Home Upgrades Past 10 Yrs</th>
        </tr>
        <tr>
            <td>
                <strong>HAVE HOA: </strong> <?php echo $obj->app->home->hoa->have;?><br />
                <strong>NAME: </strong> <?php echo $obj->app->home->hoa->name;?><br />
                <strong>AMOUNT: </strong> <?php echo $obj->app->home->amount;?>
            </td>
            <td>
                <?php echo (!empty($obj->app->home->upgrades->description))?$obj->app->home->upgrades->description:'<br /><br />';?>
            </td>
        </tr>
        <tr>
            <th>Hardwood Floors? Describe</th><th>Bathroom Upgrades? Describe</th>
        </tr>
        <tr>
            <td>
                <?php echo (!empty($obj->app->home->upgrades->hardwoodFloors))?$obj->app->home->upgrades->hardwoodFloors:'<br /><br />';?>
            </td>
            <td>
                <?php echo (!empty($obj->app->home->upgrades->bathroom))?$obj->app->home->upgrades->bathroom:'<br /><br />';?>
            </td>
        </tr>
        <tr>
            <th>Kitchen Upgrades? Describe</th><th>Things Need Fixing? Describe</th>
        </tr>
        <tr>
            <td>
                <?php echo (!empty($obj->app->home->upgrades->kitchen))?$obj->app->home->upgrades->kitchen:'<br /><br />';?>
            </td>
            <td>
                <?php echo (!empty($obj->app->home->needFixing))?$obj->app->home->needFixing:'<br /><br />';?>
            </td>
        </tr>

        <tr>
            <th>Client Home Rating (1-10)</th><th>Need Money Now? Describe</th>
        </tr>
        <tr>
            <td>
                <?php echo (!empty($obj->app->home->customerRating))?$obj->app->home->customerRating:'<br /><br />';?>
            </td>
            <td>
                <?php echo (!empty($obj->app->needMoneyFor->description))?$obj->app->needMoneyFor->description:'<br /><br />';?>
            </td>
        </tr>

        <tr>
            <th>Liens or Judgements? Describe</th><th>How much do you need?</th>
        </tr>
        <tr>
            <td>
                <?php echo (!empty($obj->app->liensOrJudgements))?$obj->app->liensOrJudgements:'<br /><br />';?>
            </td>
            <td>
                <?php echo (!empty($obj->app->needMoneyFor->howMuch))?$obj->app->needMoneyFor->howMuch:'<br /><br />';?>
            </td>
        </tr>

    </table>

    <table>
        <tr>
            <th>Notes</th><th></th>
        </tr>
        <tr>
            <td class="full" colspan="2">
                <?php echo (!empty($obj->app->notes))?$obj->app->notes:'<br /><br /><br /><br /><br /><br /><br /><br />';?>
            </td>
        </tr>
    </table>
</h1>
</body>
</html>
