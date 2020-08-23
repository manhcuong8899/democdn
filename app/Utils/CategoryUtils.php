<?php

namespace Fully\Utils;

use Fully\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryUtils {

    /* Add New */
    public static function getCategories($lang,$module) {
        $categoryQuery = "SELECT CONCAT( REPEAT('---',COUNT(parent.name) - 1), node.name) AS name, node.cat_img, node.slug, node.id, node.status ";
        $categoryQuery .= "FROM categories AS node, ";
        $categoryQuery .= "categories AS parent ";
        $categoryQuery .= "WHERE node.lang = ? AND parent.lang = ? AND node.module = ? AND parent.module = ? ";
        $categoryQuery .= "AND node.lft BETWEEN parent.lft AND parent.rgt ";
        $categoryQuery .= "GROUP BY node.name ";
        $categoryQuery .= "ORDER BY node.lft ";
        return DB::select($categoryQuery, array($lang, $lang,$module,$module));
    }

    public static function create($formData) {
        if($formData['parent_id'] == 0) {
            $temp = Category::where('lang', $formData['lang'])->select('rgt')->orderBy('rgt', 'DESC')->first();
            $myRgt = isset($temp) ? $temp->rgt + 1 : 0;
            $formData['lft'] = $myRgt;
            $formData['rgt'] = $myRgt + 1;
            return Category::create($formData);
        } else {
            $myRgt = Category::where('lang', $formData['lang'])->where('id', $formData['parent_id'])->select('rgt')->first()->rgt;
            Category::where('lang', $formData['lang'])->where('rgt', '>=', $myRgt)->increment('rgt', 2);
            Category::where('lang', $formData['lang'])->where('lft', '>', $myRgt)->increment('lft', 2);
            $formData['lft'] = $myRgt;
            $formData['rgt'] = $myRgt + 1;
            return Category::create($formData);
        }
    }

    /* Edit New */

    public static function update_node($formData,$id) {
        if($formData['parent_id'] == 0) {
            /* Sắp xếp lại thứ tự trong bao cha của phần tử bị di chuyển */
            $oldFft = Category::find($id)->lft;
            $oldRgt = Category::find($id)->rgt;

            Category::where('lang', $formData['lang'])->where('rgt', '>', $oldFft)->decrement('rgt', 1);
            Category::where('lang', $formData['lang'])->where('lft', '>', $oldFft)->decrement('lft', 1);

            Category::where('lang', $formData['lang'])->where('rgt', '>', $oldRgt-1)->decrement('rgt', 1);
            Category::where('lang', $formData['lang'])->where('lft', '>', $oldRgt-1)->decrement('lft', 1);

            $temp = Category::where('lang', $formData['lang'])->select('rgt')->orderBy('rgt', 'DESC')->first();
            $myRgt = isset($temp) ? $temp->rgt + 1 : 0;
            $formData['lft'] = $myRgt;
            $formData['rgt'] = $myRgt + 1;


            return Category::find($id)->update($formData);
        } else {
            /* Sắp xếp lại thứ tự trong bao cha của phần tử bị di chuyển */
            $oldFft = Category::find($id)->lft;
            $oldRgt = Category::find($id)->rgt;

            Category::where('lang', $formData['lang'])->where('rgt', '>', $oldFft)->decrement('rgt', 1);
            Category::where('lang', $formData['lang'])->where('lft', '>', $oldFft)->decrement('lft', 1);

            Category::where('lang', $formData['lang'])->where('rgt', '>', $oldRgt-1)->decrement('rgt', 1);
            Category::where('lang', $formData['lang'])->where('lft', '>', $oldRgt-1)->decrement('lft', 1);

            /*--------------------------- */
            $myRgt = Category::where('lang', $formData['lang'])->where('id', $formData['parent_id'])->select('rgt')->first()->rgt;
            Category::where('lang', $formData['lang'])->where('rgt', '>=', $myRgt)->increment('rgt', 2);
            Category::where('lang', $formData['lang'])->where('lft', '>', $myRgt)->increment('lft', 2);

            $formData['lft'] = $myRgt;
            $formData['rgt'] = $myRgt + 1;

            return Category::find($id)->update($formData);
        }
    }

    public static function update_allchild($formData,$id) {

        if($formData['parent_id'] == 0) {

            /* Tăng giá trị của của các node thuộc nhánh trước khi chuyển */

            $nodeend = Category::where('lang', $formData['lang'])->select('rgt','id')->orderBy('rgt', 'DESC')->first();

            $myRgt = isset($nodeend) ? $nodeend->rgt: 0;
            $nodeend_id =  isset( $nodeend) ?  $nodeend->id: 0;

            $oldFft = Category::find($id)->lft;
            $oldRgt = Category::find($id)->rgt;

            Category::where('lang', $formData['lang'])->where('rgt', '<=', $oldRgt)
                                                      ->where('rgt', '>',  $oldFft)
                                                      ->increment('rgt', $myRgt);

            Category::where('lang', $formData['lang'])->where('lft', '<', $oldRgt)
                                                      ->where('lft', '>=',$oldFft)
                                                      ->increment('lft', $myRgt);

            /* Giảm giá trị phía bên phải nút di chuyển */

            $with = ($oldRgt - $oldFft) + 1;

            Category::where('lang', $formData['lang'])  ->where('rgt', '>', $oldRgt)
                                                        ->where('rgt', '<=', $myRgt)
                                                        ->decrement('rgt', $with);

            Category::where('lang', $formData['lang'])->where('lft', '>', $oldRgt)
                                                        ->where('lft', '<', $myRgt)
                                                        ->decrement('lft', $with);

            /* Xác định nút right cuối và giá trị left của nút chuyển */
            $new = Category::find($nodeend_id);
            $node_move = Category::find($id);

            /* Xác định giá trị cần giảm đi để bảo toàn dãy số */
            $dec = $node_move->lft - $new->rgt - 1;

            Category::where('lang', $formData['lang'])->where('rgt', '>',$new->rgt)->decrement('rgt',$dec);
            Category::where('lang', $formData['lang'])->where('lft', '>',$new->rgt)->decrement('lft',$dec);

            return Category::find($id)->update($formData);


        } else {



            /* Tăng giá trị của của các note sau left của parent được chọn */

            $nodeend = Category::where('lang', $formData['lang'])->select('rgt')->orderBy('rgt', 'DESC')->first();


            $parent = Category::where('lang', $formData['lang'])->where('id', $formData['parent_id'])->select('lft','id')->first();

            $nodemove = Category::find($id);


            if($parent->lft > $nodemove->lft )
            {

                Category::where('lang', $formData['lang'])->where('rgt', '>',$parent->lft)
                    ->increment('rgt', $nodeend->rgt);

                Category::where('lang', $formData['lang'])->where('lft', '>', $parent->lft)
                    ->increment('lft', $nodeend->rgt);

                /* Tăng giá trị của của các node thuộc nhánh trước khi chuyển */


                Category::where('lang', $formData['lang'])->where('rgt', '<=', $nodemove->rgt)
                    ->where('rgt', '>',  $nodemove->lft)
                    ->increment('rgt', $nodeend->rgt);

                Category::where('lang', $formData['lang'])->where('lft', '<', $nodemove->rgt)
                    ->where('lft', '>=',$nodemove->lft)
                    ->increment('lft', $nodeend->rgt);


                /* Giảm giá trị Lớn hơn Right của node và nhỏ hơn hoặc bằng Left của Parent */

                $with = ($nodemove->rgt - $nodemove->lft) + 1;

                Category::where('lang', $formData['lang'])  ->where('rgt', '>', $nodemove->rgt)
                    ->where('rgt', '<=', $parent->lft)
                    ->decrement('rgt', $with);

                Category::where('lang', $formData['lang'])->where('lft', '>', $nodemove->rgt)
                    ->where('lft', '<=', $parent->lft)
                    ->decrement('lft', $with);

                /* Xác định lại Left và Right của Node*/

                $new_node = Category::find($id);

                $new_parent = Category::find($formData['parent_id']);

                /* Xác định giá trị cần giảm đi trong node */

                $dec_node = $new_node->lft -  $new_parent->lft - 1;

                /* Giảm giá trị của node move */
                Category::where('lang', $formData['lang'])->where('rgt', '<=', $new_node->rgt)
                    ->where('rgt', '>', $new_node->lft)
                    ->decrement('rgt',$dec_node);

                Category::where('lang', $formData['lang'])->where('lft', '<', $new_node->rgt)
                    ->where('lft', '>=', $new_node->lft)
                    ->decrement('lft',$dec_node);

                /* Xác định lại Left và Right của Node và Parent*/


                $new_node2 = Category::find($id);

                $new_parent2 = Category::find($formData['parent_id']);

                /* Xác định giá trị cần giảm đi phía phải Node */

                $dec_right = $new_parent2->rgt -  $new_node2->rgt - 1;

                Category::where('lang', $formData['lang'])->where('rgt', '>',$new_node2->rgt)->decrement('rgt',$dec_right);
                Category::where('lang', $formData['lang'])->where('lft', '>',$new_node2->rgt)->decrement('lft',$dec_right);

            }

            else
            {
                dd( $parent->lft);
            }


            return Category::find($id)->update($formData);

        }



    }

}