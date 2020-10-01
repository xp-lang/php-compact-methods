<?php namespace lang\ast\syntax\php;

use lang\ast\Node;
use lang\ast\nodes\{Method, ReturnStatement};
use lang\ast\syntax\Extension;

/**
 * Compact methods
 *
 * ```php
 * // Syntax
 * class Person {
 *   private string $name;
 *   public fn name(): string => $this->name;
 * }
 *
 * // Rewritten to
 * class Person {
 *   private string $name;
 *   public function name(): string { return $this->name; }
 * }
 * ```
 *
 * @see  https://wiki.php.net/rfc/arrow_functions_v2#allow_arrow_notation_for_real_functions
 * @see  https://github.com/xp-framework/rfc/issues/241
 * @test xp://lang.ast.syntax.php.unittest.CompactMethodsTest
 */
class CompactMethods implements Extension {

  public function setup($language, $emitter) {
    $language->body('fn', function($parse, &$body, $meta, $modifiers) {
      $line= $parse->token->line;
      $comment= $parse->comment;
      $parse->comment= null;

      $parse->forward();
      $name= $parse->token->value;
      $lookup= $name.'()';
      if (isset($body[$lookup])) {
        $parse->raise('Cannot redeclare method '.$lookup);
      }

      $parse->forward();
      $signature= $this->signature($parse, $meta[DETAIL_TARGET_ANNO] ?? []);

      $parse->expecting('=>', 'compact method');
      $return= new ReturnStatement($this->expression($parse, 0), $parse->token->line);
      $parse->expecting(';', 'compact method');

      $body[$lookup]= new Method(
        $modifiers,
        $name,
        $signature,
        [$return],
        $meta[DETAIL_ANNOTATIONS] ?? [],
        $comment,
        $line
      );
    });
  }
}