<?php namespace lang\ast\syntax\php\unittest;

use lang\IllegalArgumentException;
use lang\ast\Errors;
use lang\ast\unittest\emit\EmittingTest;
use unittest\Assert;

class CompactMethodsTest extends EmittingTest {

  #[@test]
  public function with_scalar() {
    $r= $this->run('class <T> {
      public fn run() => "test";
    }');
    Assert::equals('test', $r);
  }

  #[@test]
  public function with_property() {
    $r= $this->run('class <T> {
      private $id= "test";

      public fn run() => $this->id;
    }');
    Assert::equals('test', $r);
  }

  #[@test]
  public function combined_with_argument_promotion() {
    $r= $this->run('class <T> {
      public fn withId(private $id) => $this;
      public fn id() => $this->id;

      public function run() {
        return $this->withId("test")->id();
      }
    }');
    Assert::equals('test', $r);
  }

  #[@test, @expect(IllegalArgumentException::class)]
  public function throw_expression_with_compact_method() {
    $this->run('use lang\IllegalArgumentException; class <T> {
      public fn run() => throw new IllegalArgumentException("test");
    }');
  }

  #[@test, @expect(Errors::class)]
  public function cannot_redeclare() {
    $this->type('class <T> {
      public fn run() => "test1";
      public fn run() => "test2";
    }');
  }

  #[@test]
  public function method_annotations() {
    $t= $this->type('class <T> {
      <<test>> public fn fixture() => "test";
    }');
    Assert::equals(['test' => null], $t->getMethod('fixture')->getAnnotations());
  }

  #[@test]
  public function param_annotations() {
    $t= $this->type('class <T> {
      public fn fixture(<<test>> $a) => "test";
    }');
    Assert::equals(['test' => null], $t->getMethod('fixture')->getParameter(0)->getAnnotations());
  }
}